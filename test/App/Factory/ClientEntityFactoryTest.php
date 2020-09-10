<?php

namespace App\Factory;

use App\Exception\AssertionException;
use App\Util\Assert;
use PHPUnit\Framework\TestCase;

class ClientEntityFactoryTest extends TestCase
{

    public function testFromArray()
    {
        $factory = new ClientEntityFactory(new Assert());
        $entity = $factory->fromArray(["Carl", "100", "30.01.2020"]);

        $this->assertEquals("Carl", $entity->getName());
        $this->assertEquals(100, $entity->getCredit());
        $this->assertEquals(new \DateTimeImmutable('30.1.2020'), $entity->getLastTopUpDate());
    }

    public function testFromArrayNegative()
    {
        $this->expectException(AssertionException::class);
        $factory = new ClientEntityFactory(new Assert());
        $entity = $factory->fromArray([7, "100", "30.01.2020"]);
    }

}
