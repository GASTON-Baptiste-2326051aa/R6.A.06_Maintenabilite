<?php

namespace App\Tests\Unit;

use App\Entity\Sport;
use PHPUnit\Framework\TestCase;

class SportTest extends TestCase
{
    public function testSportWithName(): void
    {
        $sport = new Sport();
        $sport->setName('Football');

        $this->assertSame('Football', $sport->getName());
    }
}
