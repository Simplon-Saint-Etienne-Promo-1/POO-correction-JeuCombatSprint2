<?php

abstract class Hero extends Character
{
    protected int $mana = 100; 

    /**
     * Réduit les points de vie du hero et retourne les dégâts
     * 
     * @param Monster $monster
     */
    public function hit($monster): int
    {
        $damage = rand(0,20);

        $monster->setHealthPoints($monster->getHealthPoints() - $damage);

        return $damage;
    }

    public function specialAttack($monster): int
    {
        $manaCost = rand(20,25);

        if($this->mana >= $manaCost) {
            $damage = rand(1,50);
            $monster->setHealthPoints($monster->getHealthPoints() - $damage);
            $this->mana -= $manaCost;
            return $damage;
        }

        return 0;
    }
}
