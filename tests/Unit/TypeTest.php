<?php

namespace App\Tests\Unit;

use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    public function testTypeWithName(): void
    {
        $type = new Type();
        $type->setName('individuel');

        $this->assertSame('individuel', $type->getName());
    }
}
