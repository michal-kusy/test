<?php declare(strict_types=1);

namespace App\Util;

class Statistics implements StatisticsInterface
{

    /** @var int[] */
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function addOne(string $key): void
    {
        if (!isset($this->data[$key])) {
            $this->data[$key] = 0;
        }

        $this->data[$key]++;
    }

    /** @return int[] */
    public function toArray(): array
    {
        return $this->data;
    }
}
