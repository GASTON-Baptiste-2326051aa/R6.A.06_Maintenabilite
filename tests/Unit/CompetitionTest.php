<?php

namespace App\Tests\Unit;

use App\Entity\Competition;
use App\Entity\Championship;
use PHPUnit\Framework\TestCase;

class CompetitionTest extends TestCase
{
    public function testCompetitionWithName(): void
    {
        $competition = new Competition();
        $competition->setName('Coupe de France');

        $this->assertSame('Coupe de France', $competition->getName());
    }

}
