<?php

class FightsManager
{
    public function __construct()
    {
    }

    public function fight(Hero $hero, Monster $monster): array
    {
        $fightResults = [];

        do {
            $degats = $monster->hit($hero);
            $fightResults[] = $monster->getName() . " a frappé " . $hero->getName() . " de " . $degats . " points de dégâts";

            if ($hero->getHealthPoints() <= 0) {
                $fightResults[] = $hero->getName() . " est mort sous les coups du monstre";
                break;
            }

            if (!rand(0, 3)) {
                $degatsAttaqueSpeciale = $hero->specialAttack($monster);
                $fightResults[] = $hero->getName() . " a utilisé son attaque spéciale ⭐ !  " . $monster->getName() . " subit " . $degatsAttaqueSpeciale . " points de dégâts";
            } else {
                $degats = $hero->hit($monster);
                $fightResults[] = $hero->getName() . " a frappé " . $monster->getName() . " de " . $degats . " points de dégâts";
            }

            if ($monster->getHealthPoints() <= 0) {
                $fightResults[] = $monster->getName() . " est mort sous les coups du héro";
                break;
            }
        } while ($monster->getHealthPoints() > 0);

        return $fightResults;
    }

    public function createMonster(): Monster
    {
        $randomMonsterNames = [
            "Frostcat",
            "Blightclaw",
            "Cavehand",
            "Abyssscream",
            "The Ancient Statue",
            "The Delirious Tumor",
            "The Thin Howler",
            "The Masked Dawn Buffalo",
            "The Hidden Ghost Leviathan",
            "The Long-Horned Predator Critter"
        ];

        $randomMonsterTypes = [
            'ogre',
            'infantryMan',
            'wizard'
        ];

        $monsterData = [
            "name" => $randomMonsterNames[array_rand($randomMonsterNames)],
            "health_points" => 100,
            "type" => $randomMonsterTypes[array_rand($randomMonsterTypes)]
        ];

        return match ($monsterData["type"]) {
            'ogre' => new Ogre($monsterData),
            'infantryMan' => new InfantryMan($monsterData),
            'wizard' => new Wizard($monsterData),
        };
    }
}
