<?php


namespace App\Factory;

use App\Entity\ClientEntity;
use App\Util\Assert;
use App\Util\AssertInterface;
use DateTimeImmutable;

class ClientEntityFactory implements ClientEntityFactoryInterface
{

    /** @var AssertInterface */
    private $assert;

    public function __construct(AssertInterface $assert)
    {
        $this->assert = $assert;
    }

    /**
     * @inheritDoc
     */
    public function fromArray(array $data): ClientEntity
    {
        $this->assert->hasNumberOfElements($data, 3);

        $name = $data[0];
        $credit = $data[1];
        $lastTopUpDate = $data[2];

        $this->assert->isString($name);
        $this->assert->isIntegerString($credit);
        $this->assert->isDateString($lastTopUpDate);

        $credit = (int) $credit;
        $lastTopUpDate = new DateTimeImmutable($lastTopUpDate);


        return new ClientEntity($name, $credit, $lastTopUpDate);
    }
}
