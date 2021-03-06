<?php declare(strict_types=1);

namespace App\Resolver;

class ContextBag implements ContextInterface
{
    /** @var mixed[] */
    private $data;

    /**
     * @param  mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}
