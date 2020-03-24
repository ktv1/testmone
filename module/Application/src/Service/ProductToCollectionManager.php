<?php
namespace Application\Service;

use Application\Entity\ProductToCollection;

class ProductToCollectionManager
{
    /**
     * @var
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addNewCollect($data)
    {
        //before delete existing collects by product_id and collection_id
        $delcollects = $this->entityManager->getRepository(ProductToCollection::class)
            ->findOneBy(array(
                'collection_id' => $data->collection_id,
                'product_id'    => $data->product_id
            ));
        // delete
        if($delcollects) {
            $this->entityManager->remove($delcollects);
        }
        // apply changes
        $this->entityManager->flush();

        $collect = new ProductToCollection();
        $collect->setId($data->id);
        $collect->setCollectionId($data->collection_id);
        $collect->setProductId($data->product_id);
        $collect->setSort($data->sort);

        // Add the entity to entity manager.
        $this->entityManager->persist($collect);

        // Apply changes to database.
        $this->entityManager->flush();
    }
}