<?php

// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un périphérique de stockage
 */
class Hdd
{
    /**
     * Identifiant en base de données
     * @var integer|null
     */
    private ?int $id;
    /**
     * Nom du composant
     * @var string
     */
    private string $name;
    /**
     * Prix du composant
     * @var float
     */
    private float $price;
    /**
     * Identifiant en base de données de la marque du composant
     * @var integer|null
     */
    private ?int $brandId;
    /**
     * Capacité de stockage
     * @var integer
     */
    private int $size;
    /**
     * Type de stockage
     * 0 = disque dur
     * 1 = SSD
     * @var integer
     */
    private int $type;

    /**
     * Récupère tous les périphériques de stockage en base de données
     *
     * @return Hdd[]
     */
    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('hdds') as $hddData) {
            $hdds []= new Hdd(
                $hddData['id'],
                $hddData['name'],
                $hddData['price'],
                $hddData['brand_id'],
                $hddData['size'],
                $hddData['type']
            );
        }
        return $hdds;
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     * @param integer $size Capacité de stockage
     * @param integer $type Type de stockage
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $size = 0,
        int $type = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
        $this->size = $size;
        $this->type = $type;
    }

    /**
     * Get identifiant en base de données
     *
     * @return  integer|null
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get nom du composant
     *
     * @return  string
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get prix du composant
     *
     * @return  float
     */ 
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Get marque du composant
     *
     * @return  Brand|null
     */ 
    public function getBrand(): ?Brand
    {
        return Brand::findById($this->brandId);
    }

    /**
     * Get capacité de stockage
     *
     * @return  integer
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get Type de stockage
     *
     * @return  integer
     */ 
    public function getType(): int
    {
        return $this->type;
    }
}
