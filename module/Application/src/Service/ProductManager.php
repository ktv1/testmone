<?php
namespace Application\Service;

use Application\Entity\Products;

class ProductManager
{
    /**
     * @var
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * add new product
     * @param $data
     */
    public function addNewProduct($data)
    {
        $product = new Products();
        $product->setId($data->id);
        $date = new \DateTime(date("Y-m-d H:i:s"));
        $product->setTitle($data->title);
        $product->setBodyHtml($data->body_html);
        $product->setVendor($data->vendor);
        $product->setProductType($data->product_type);
        $product->setCreatedAt($date);
        $product->setHandle($data->handle);
        $product->setVariants(json_encode($data->variants));
        $product->setOptions(json_encode($data->options));

        $img = isset($data->image->src) ? $data->image->src : 'placeholder.png';
        $product->setImage($img);

        // Add the entity to entity manager.
        $this->entityManager->persist($product);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * edit product
     * @param $product
     * @param $data
     */
    public function editProduct($product, $data)
    {
        $date = new \DateTime($data->created_at);
        $product->setTitle($data->title);
        $product->setBodyHtml($data->body_html);
        $product->setVendor($data->vendor);
        $product->setProductType($data->product_type);
        $product->setCreatedAt($date);
        $product->setHandle($data->handle);
        $product->setVariants(json_encode($data->variants));
        $product->setOptions(json_encode($data->options));

        $img = isset($data->image->src) ? $data->image->src : 'placeholder.png';
        $product->setImage($img);

        // Apply changes to database.
        $this->entityManager->flush();
    }
}