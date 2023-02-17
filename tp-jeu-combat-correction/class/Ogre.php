<?php

class Ogre extends Monster
{
    public function hit($hero): int
    {
        $damage =  parent::hit($hero);

        if(is_a($hero, Archer::class)) {
            $hero->setHealthPoints($hero->getHealthPoints() - $damage);
        }

        return $damage;
    }
}
