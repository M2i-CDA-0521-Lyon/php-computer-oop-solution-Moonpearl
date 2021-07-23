<?php

// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un processeur
 */
class Cpu
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
     * Cadence du processeur
     * @var integer
     */
    private int $clock;
    /**
     * Nombre de coeurs
     * @var integer
     */
    private int $cores;

    /**
     * Récupère tous les processeurs en base de données
     *
     * @return Cpu[]
     */
    static public function findAll(): array
    {        
        foreach (SqlDatabaseHandler::fetchAll('cpus') as $cpuData) {
            $cpus []= new Cpu(
                $cpuData['id'],
                $cpuData['name'],
                $cpuData['price'],
                $cpuData['brand_id'],
                $cpuData['clock'],
                $cpuData['cores']
            );
        }
        return $cpus;
    }

    /**
     * Récupère un processeur en base de données en fonction de son identifiant
     *
     * @param integer $id
     * @return void
     */
    static public function findById(int $id)
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `cpus` WHERE `id` = :id');
        $statement->execute([ ':id' => $id ]);
        $cpuData = $statement->fetch();
        if ($cpuData === false) {
            return null;
        }
        return new Cpu(
            $cpuData['id'],
            $cpuData['name'],
            $cpuData['price'],
            $cpuData['brand_id'],
            $cpuData['clock'],
            $cpuData['cores']
        );
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     * @param integer $clock Cadence du processeur
     * @param integer $cores Nombre de coeurs
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $clock = 0,
        int $cores = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brandId = $brandId;
        $this->clock = $clock;
        $this->cores = $cores;
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
     * Get cadence du processeur
     *
     * @return  integer
     */ 
    public function getClock(): int
    {
        return $this->clock;
    }

    /**
     * Get nombre de coeurs
     *
     * @return  integer
     */ 
    public function getCores(): int
    {
        return $this->cores;
    }
}
