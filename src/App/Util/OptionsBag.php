<?php declare(strict_types=1);

namespace App\Util;

class OptionsBag implements OptionsBagInterface
{

    /** @var mixed[] */
    private $options;

    /**
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function getInt(string $key, int $defaultValue = 0): int
    {
        return $this->options[$key] ?? $defaultValue;
    }

    public function getString(string $key, string $defaultValue = ''): string
    {
        return $this->options[$key] ?? $defaultValue;
    }
}
