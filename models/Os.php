<?php

// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un systéme d'exploitation
 */
class Os
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
     * Récupère tous les systémes d'exploitation en base de données
     *
     * @return Os[]
     */
    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('os') as $osData) {
            $oss []= new Os(
                $osData['id'],
                $osData['name'],
                $osData['price'],
                $osData['brand_id'],
            );
        }
        return $oss;
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null
    ) {
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
}
