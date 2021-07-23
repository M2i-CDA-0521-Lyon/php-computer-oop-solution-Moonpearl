<?php

// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente uné mémoire vive
 */
class Ram
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
     * Capacité de chaque barrette
     * @var integer
     */
    private int $chipsetSize;
    /**
     * Nombre de barrettes
     * @var integer
     */
    private int $chipsetCount;

    /**
     * Récupère toutes les mémoires en base de données
     *
     * @return Ram[]
     */
    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('rams') as $ramData) {
            $rams []= new Ram(
                $ramData['id'],
                $ramData['name'],
                $ramData['price'],
                $ramData['brand_id'],
                $ramData['chipset_size'],
                $ramData['chipset_count']
            );
        }
        return $rams;
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     * @param integer $chipsetSize Capacité de chaque barrette
     * @param integer $chipsetCount Nombre de barrettes
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $chipsetSize = 0,
        int $chipsetCount = 1
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
        $this->chipsetSize = $chipsetSize;
        $this->chipsetCount = $chipsetCount;
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
     * Get capacité de chaque barrette
     *
     * @return  integer
     */ 
    public function getChipsetSize(): int
    {
        return $this->chipsetSize;
    }

    /**
     * Get nombre de barrettes
     *
     * @return  integer
     */ 
    public function getChipsetCount(): int
    {
        return $this->chipsetCount;
    }
}
