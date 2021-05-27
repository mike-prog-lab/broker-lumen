<?php


namespace App\Helpers;


use Prophecy\Exception\Doubler\MethodNotFoundException;

/**
 * Trait Constructable
 * @package App\Helpers
 */
trait Constructable
{
    /**
     * If true - search for function with prefix 'set' per key.
     *
     * @var bool
     */
    protected bool $useSetters = true;

    /**
     * Construct entity values from args array.
     *
     * @param array $args
     * @return Constructable
     */
    protected function constructArgs(array $args): self
    {
        foreach ($args as $key => $inputs) {
            if ($this->useSetters) {
                $key = 'set' . ucfirst($key);

                if (!method_exists($this, $key)) {
                    continue;
                }

                $this->$key($inputs);

                continue;
            }

            $this->$key = $inputs;
        }

        return $this;
    }
}
