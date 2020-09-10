<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class ClientEntityTest extends TestCase
{

    public function testGetLastTopUpDate()
    {
        $now = new \DateTimeImmutable();
        $entity = new ClientEntity("Carl", 100, $now);
        $this->assertEquals($now, $entity->getLastTopUpDate());
    }

    public function testGetLastTopUpDateIsImmutable()
    {
        $now = new \DateTimeImmutable();
        $entity = new ClientEntity("Carl", 100, $now);
        $entity->getLastTopUpDate()->modify('-1 day');
        $this->assertSame($now, $entity->getLastTopUpDate());
    }

    public function testGetCredit()
    {
        $now = new \DateTimeImmutable();
        $credit = 100;
        $entity = new ClientEntity("Carl", $credit, $now);
        $this->assertEquals($credit, $entity->getCredit());
    }

    public function testGetName()
    {
        $now = new \DateTimeImmutable();
        $name = "Carl";
        $entity = new ClientEntity($name, 100, $now);
        $this->assertEquals($name, $entity->getName());
    }
}
