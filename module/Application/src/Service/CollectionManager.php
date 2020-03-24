<?php
namespace Application\Service;


use Application\Entity\Collections;

class CollectionManager
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
     * add new collection
     * @param $data
     */
    public function addNewCollection($data)
    {
        $collection = new Collections();
        $collection->setId($data->collection_id);
        $date = new \DateTime(date("Y-m-d H:i:s"));
        $collection->setUpdatetAt($date);
        $collection->setBodyHtml($data->body_html);
        $collection->setDefaultProductImage($data->default_product_image);
        $collection->setHandle($data->handle);
        $collection->setImage(json_encode($data->image));
        $collection->setTitle($data->title);
        $collection->setSortOrder($data->sort_order);

        // Add the entity to entity manager.
        $this->entityManager->persist($collection);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * edit collection
     * @param $collection
     * @param $data
     */
    public function editCollection($collection, $data)
    {
        $date = new \DateTime($data->updated_at);
        $collection->setUpdatetAt($date);
        $collection->setBodyHtml($data->body_html);
        $collection->setDefaultProductImage($data->image);
        $collection->setDefaultProductImage($data->default_product_image);
        $collection->setHandle($data->handle);
        $collection->setDefaultProductImage(json_encode($data->image));
        $collection->setTitle($data->title);
        $collection->setSortOrder($data->sort_order);

        // Apply changes to database.
        $this->entityManager->flush();
    }
}