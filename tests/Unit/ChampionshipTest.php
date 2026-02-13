<?php

namespace App\Tests\Unit;

use App\Entity\Championship;
use App\Entity\Sport;
use PHPUnit\Framework\TestCase;

class ChampionshipTest extends TestCase
{
    public function testChampionshipWithName(): void
    {
        $championship = new Championship();
        $championship->setName('Ligue 1');

        $this->assertSame('Ligue 1', $championship->getName());
    }
}
