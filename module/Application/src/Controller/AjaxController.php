<?php

namespace Application\Controller;

use Application\Entity\Collections;
use Application\Entity\Products;
use Application\Entity\ProductToCollection;
use Application\Service\CollectionManager;
use Application\Service\ProductManager;
use Application\Service\ProductToCollectionManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Zend\Http\Client as Client;
use Zend\Json\Json as Json;
use Zend\Http\Client\Cookies as Cookies;
use Laminas\View\Model\JsonModel;

class AjaxController extends AbstractActionController
{
    private $container;

    private $entityManager;

    private $collection_manager;

    private $product_manager;

    private $product_to_collection_manager;

    public function __construct($container)
    {
        $this->container = $container;

        $this->entityManager = $container->get('doctrine.entitymanager.orm_default');

        $this->collection_manager = new CollectionManager($this->entityManager);

        $this->product_manager = new ProductManager($this->entityManager);

        $this->product_to_collection_manager = new ProductToCollectionManager($this->entityManager);
    }

    public function indexAction()
    {

        return;
    }

    public function processAjaxRequestAction(){
        $result = array();
        if($this->getRequest()->isXmlHttpRequest()){
            if($this->getRequest()->isPost()) {
                $config = $this->container->get('Config');
                $api_key = isset($config['shopify']['api_key']) ? $config['shopify']['api_key'] : '';
                $pass = isset($config['shopify']['pass']) ? $config['shopify']['pass'] : '';

                $param = $this->getRequest()->getPost('param');
                if(($param == '') || ($api_key == '') || ($pass == '')) {
                    return new JsonModel(['error' => 'Error auth ']);
                } else {

                    $client = new Client('https://' . $api_key . ':' . $pass . '@testmone.myshopify.com/admin/api/2020-01/' . $param . '.json');

                    /*$client->setHeaders([
                        'accept-encoding' => 'gzip, deflate, br',
                        'accept-language' => 'uk-UA,uk;q=0.9,ru;q=0.8,en-US;q=0.7,en;q=0.6'
                    ]);*/
                    $client->setMethod('GET')->send();

                    $response = $client->getResponse();

                    if ($response->getStatusCode() == '200') { //if is Ok
                        $response_data = $response->getBody();
                        $data = Json::decode($response_data);

                        if (isset($data->collection_listings)) {
                            $add = 0;
                            $edit = 0;
                            foreach ($data->collection_listings as $collection) {
                                // insert or update Collection
                                $collect = $this->entityManager->getRepository(Collections::class)->find($collection->collection_id);
                                if($collect) {
                                    $this->collection_manager->editCollection($collect,$collection);
                                    $add++;
                                } else {
                                    $this->collection_manager->addNewCollection($collection);
                                    $edit++;
                                }
                            }
                            $result['success'] = 'Ok';
                            $result['message'] = $add . ' collections added, ' . $edit . ' collections updated';
                        } elseif (isset($data->products)) {
                            $add = 0;
                            $edit = 0;
                            foreach ($data->products as $product) {
                                // insert or update Product
                                $prod = $this->entityManager->getRepository(Products::class)->find($product->id);
                                if($prod) {
                                    $this->product_manager->editProduct($prod,$product);
                                    $edit++;
                                } else {
                                    $this->product_manager->addNewProduct($product);
                                    $add++;
                                }
                            }
                            $result['success'] = 'Ok';
                            $result['message'] = $add . ' products added, ' . $edit . ' products updated';
                        } elseif (isset($data->collects)) {
                            $add = 0;
                            foreach ($data->collects as $collect) {
                                $this->product_to_collection_manager->addNewCollect($collect);
                                $add++;
                            }
                            $result['success'] = 'Ok';
                            $result['message'] = $add . ' collects added';
                        }
                    } else {
                        $result['error'] = 'error';
                    }
                }
            } else {
                $result['error'] = 'Is not POST';
            }
        }
        return new JsonModel($result);
    }
}