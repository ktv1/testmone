<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product_to_collection")
 */
class ProductToCollection
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="collection_id")
     */
    protected $collection_id;

    /**
     * @ORM\Column(name="product_id")
     */
    protected $product_id;

    /**
     * @ORM\Column(name="sort")
     */
    protected $sort;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCollectionId()
    {
        return $this->collection_id;
    }

    /**
     * @param mixed $collection_id
     */
    public function setCollectionId($collection_id)
    {
        $this->collection_id = $collection_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

}