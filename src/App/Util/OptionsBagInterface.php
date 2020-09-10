<?php

namespace App\Util;

interface OptionsBagInterface
{
    public function getInt(string $key, int $defaultValue = 0): int;

    public function getString(string $key, string $defaultValue = ''): string;
}
