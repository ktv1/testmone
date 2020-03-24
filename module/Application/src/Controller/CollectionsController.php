<?php

namespace Application\Controller;

use Application\Entity\Collections;
use Application\Entity\Products;
use Application\Entity\ProductToCollection;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CollectionsController extends AbstractActionController
{
   private $entityManager;

   private $container;

   public function __construct($container)
   {
       $this->entityManager = $container->get('doctrine.entitymanager.orm_default');

       $this->container = $container;
   }

    public function indexAction()
    {
        $id = $this->params()->fromRoute('id');
        if ($id) {

            // get products in collection
            $collections = $this->entityManager->getRepository(ProductToCollection::class)
                ->findBy(['collection_id' => $id],['sort' => 'DESC']);

            $products = array();
            if($collections) {
                foreach ($collections as $collection) {
                    $product = $this->entityManager->getRepository(Products::class)
                        ->findOneById($collection->getProductId());
                    if($product) {
                        $products[$collection->getProductId()] = $product;
                    }
                }
            }

            // get collection
            $mainCollection = $this->entityManager->getRepository(Collections::class)
                ->findOneById($id);

            $viewModel = new ViewModel([
                'products' => $products,
                'collection' => $mainCollection
            ]);

            $viewModel->setTemplate('collections/application/products');

            return $viewModel;

        } else {
            $collections = $this->entityManager->getRepository(Collections::class)
                ->findBy([], ['sort_order' => 'DESC']);
            return new ViewModel([
                'collections' => $collections,
            ]);
        }
    }
}