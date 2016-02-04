<?php

namespace App\Entity;

/**
 * @Entity @Table(name="products")
 **/
class Product
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $content;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}