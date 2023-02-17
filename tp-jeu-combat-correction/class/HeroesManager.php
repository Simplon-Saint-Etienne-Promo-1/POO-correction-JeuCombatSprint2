<?php

class HeroesManager
{
    private PDO $db; // Instance de PDO

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function add(array $heroData)
    {
        $hero = $this->buildHero($heroData);

        $query = $this->db->prepare('INSERT INTO heroes (name, type) VALUES (:name, :type)');
        $query->bindValue(':name', $hero->getName());
        $query->bindValue(':type', $hero->getType());
        $query->execute();

        $hero->hydrate([
            'id' => $this->db->lastInsertId()
        ]);

        return $hero;
    }

    public function update(Hero $hero)
    {
        $query = $this->db->prepare('UPDATE heroes SET health_points = :health_points WHERE id = :id');
        $query->bindValue(':id', $hero->getId());
        $query->bindValue(':health_points', $hero->getHealthPoints());
        $query->execute();
    }

    public function find(int $heroId)
    {
        $query = $this->db->prepare('SELECT id,name, health_points, type FROM heroes WHERE id = :id');
        $query->bindValue(':id', $heroId);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if(!$data) {
            return null;
        }

        $hero = $this->buildHero($data);

        return $hero;
    }

    public function findAllAlive()
    {
        $query = $this->db->prepare('SELECT id,name,health_points,type FROM heroes WHERE health_points > 0');
        $query->execute();

        $heroRows = $query->fetchAll(PDO::FETCH_ASSOC);

        if(!$heroRows) {
            return [];
        }

        $heroes = [];

        foreach($heroRows as $heroRow) {
            $heroes[] = $this->buildHero($heroRow);
        }

        return $heroes;
    }

    /**
     * Get the value of db
     */ 
    public function getDb(): PDO
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb(PDO $db)
    {
        $this->db = $db;

        return $this;
    }

    protected function buildHero(array $data) 
    {
        $heroData = [
            // Données obligatoires pour instancier le héro
            'name' => $data["name"],
            'type' => $data["type"],
        ];

        // Données optionnellement renseignées en fonction du contexte
        if(isset($data["id"])) {
            $heroData["id"] = $data["id"];
        }
        if(isset($data["health_points"])) {
            $heroData["health_points"] = $data["health_points"];
        }

        return match($data["type"]) {
            'warrior' => new Warrior($heroData),
            'mage' => new Mage($heroData),
            'archer' => new Archer($heroData),
        };

    }
}
