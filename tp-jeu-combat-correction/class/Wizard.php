<?php

class Wizard extends Monster
{
    public function hit($hero): int
    {
        $damage =  parent::hit($hero);

        if(is_a($hero, Warrior::class)) {
            $hero->setHealthPoints($hero->getHealthPoints() - $damage);
        }

        return $damage;
    }
}
