<?php declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

class ClientEntity
{

    /** @var string */
    private $name;

    /** @var int */
    private $credit;

    /** @var DateTimeImmutable */
    private $lastTopUpDate;

    public function __construct(string $name, int $credit, DateTimeImmutable $lastTopUpDate)
    {
        $this->name = $name;
        $this->credit = $credit;
        $this->lastTopUpDate = $lastTopUpDate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCredit(): int
    {
        return $this->credit;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getLastTopUpDate(): DateTimeImmutable
    {
        return $this->lastTopUpDate;
    }
}
