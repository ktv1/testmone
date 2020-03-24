<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="collections")
 */
class Collections
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updated_at;

    /**
     * @ORM\Column(name="body_html")
     */
    protected $body_html;

    /**
     * @ORM\Column(name="default_product_image")
     */
    protected $default_product_image;

    /**
     * @ORM\Column(name="handle")
     */
    protected $handle;

    /**
     * @ORM\Column(name="image")
     */
    protected $image;

    /**
     * @ORM\Column(name="title")
     */
    protected $title;

    /**
     * @ORM\Column(name="sort_order")
     */
    protected $sort_order;

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
    public function getUpdatetAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updatet_at
     */
    public function setUpdatetAt($updated_at)
    {
        $this->updatet_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getBodyHtml()
    {
        return $this->body_html;
    }

    /**
     * @param mixed $body_html
     */
    public function setBodyHtml($body_html)
    {
        $this->body_html = $body_html;
    }

    /**
     * @return mixed
     */
    public function getDefaultProductImage()
    {
        return $this->default_product_image;
    }

    /**
     * @param mixed $default_product_image
     */
    public function setDefaultProductImage($default_product_image)
    {
        $this->default_product_image = $default_product_image;
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * @param mixed $sort_order
     */
    public function setSortOrder($sort_order)
    {
        $this->sort_order = $sort_order;
    }



}