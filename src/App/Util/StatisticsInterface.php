<?php

namespace App\Util;

interface StatisticsInterface
{
    public function addOne(string $key): void;

    /** @return int[] */
    public function toArray(): array;
}
