<?php

namespace SendGrid\Collection;

class Collection implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection;

    /**
     * @param array $collection
     */
    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
    }

    /**
     * @param array $collection
     * @return static
     */
    public function addMany(array $collection)
    {
        foreach ($collection as $object) {
            $this->collection[] = $object;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->collection);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->collection;
    }

    /**
     * @param callable $callable
     * @return static
     */
    public function each(callable $callable)
    {
        $collection = $this->toArray();

        array_walk($collection, $callable);

        return $this;
    }

    /**
     * @param callable $callable
     * @return static
     */
    public function map(callable $callable)
    {
        return new static(array_map($callable, $this->toArray()));
    }

    /**
     * @param callable $callable
     * @return static
     */
    public function filter(callable $callable)
    {
        return new static(array_filter($this->toArray(), $callable));
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->toArray());
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->collection[0];
    }
}
