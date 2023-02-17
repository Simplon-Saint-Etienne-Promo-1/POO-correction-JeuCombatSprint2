<?php

class Monster extends Character
{
    /**
     * Réduit les points de vie du hero et retourne les dégâts
     * 
     * @param Hero $hero
     */
    public function hit($hero): int
    {
        $damage = rand(0,25);

        $hero->setHealthPoints($hero->getHealthPoints() - $damage);

        return $damage;
    }

}
