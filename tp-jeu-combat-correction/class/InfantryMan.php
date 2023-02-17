<?php

class InfantryMan extends Monster
{

    public function hit($hero): int
    {
        $damage =  parent::hit($hero);

        if(is_a($hero, Mage::class)) {
            $hero->setHealthPoints($hero->getHealthPoints() - $damage);
        }

        return $damage;
    }
}
