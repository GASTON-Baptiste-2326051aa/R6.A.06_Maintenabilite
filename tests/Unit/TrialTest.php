<?php

namespace App\Tests\Unit;

use App\Entity\Trial;
use PHPUnit\Framework\TestCase;

class TrialTest extends TestCase
{
    /**
     *
     */
    public function testTrialWithName()
    {
        $trial = new Trial;
        $trial->setName('sprint');
        $this->assertEquals('sprint', $trial->getName());
    }
}
