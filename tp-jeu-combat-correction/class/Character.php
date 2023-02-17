<?php

abstract class Character
{
    private int $id;
    private string $name;
    private string $type;
    private int $health_points;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    /**
     * Réduit les points de vie d'un autre personnage
     */
    abstract public function hit($character): int;

    public function hydrate(array $donnees)
    {
        if(isset($donnees["id"])) {
            $this->setId($donnees["id"]);
        }
        if(isset($donnees["name"])) {
            $this->setName($donnees["name"]);
        }
        if(isset($donnees["health_points"])) {
            $this->setHealthPoints($donnees["health_points"]);
        }
        if(isset($donnees["type"])) {
            $this->setType($donnees["type"]);
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of health_points
     */ 
    public function getHealthPoints(): int
    {
        return $this->health_points;
    }

    /**
     * Set the value of health_points
     *
     * @return  self
     */ 
    public function setHealthPoints(int $health_points)
    {
        $this->health_points = $health_points;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the value of type
     */ 
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'warrior' => '⚔️ Guerrier ⚔️',
            'mage' => '🪄 Mage 🪄',
            'archer' => '🏹 Archer 🏹',
            'wizard' => '💫 Sorcier 💫',
            'ogre' => '👹 Ogre 👹',
            'infantryMan' => '🤺 Fantassin 🤺',
        };
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }
}