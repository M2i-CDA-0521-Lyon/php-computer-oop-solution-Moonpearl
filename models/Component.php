<?php

class Component
{
    /**
     * Identifiant en base de données
     * @var integer|null
     */
    protected ?int $id;
    /**
     * Nom du composant
     * @var string
     */
    protected string $name;
    /**
     * Prix du composant
     * @var float
     */
    protected float $price;
    /**
     * Identifiant en base de données de la marque du composant
     * @var integer|null
     */
    protected ?int $brandId;

    public function __construct(?int $id, string $name, float $price, ?int $brandId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
    }

    /**
     * Get identifiant en base de données
     *
     * @return  integer|null
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nom du composant
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get prix du composant
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get identifiant en base de données de la marque du composant
     *
     * @return  integer|null
     */ 
    public function getBrandId()
    {
        return $this->brandId;
    }
}
