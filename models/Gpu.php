<?php

// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente une carte graphique
 */
class Gpu extends Component
{
    /**
     * Quantité de mémoire
     * @var integer
     */
    protected int $ram;

    /**
     * Récupère tous les cartes graphiques en base de données
     *
     * @return Gpu[]
     */
    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('gpus') as $gpuData) {
            $gpus []= new Gpu(
                $gpuData['id'],
                $gpuData['name'],
                $gpuData['price'],
                $gpuData['brand_id'],
                $gpuData['ram']
            );
        }
        return $gpus;
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     * @param integer $ram Quantité de mémoire
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $ram = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
        $this->ram = $ram;
    }

    /**
     * Get quantité de mémoire
     *
     * @return  integer
     */ 
    public function getRam(): int
    {
        return $this->ram;
    }
}
