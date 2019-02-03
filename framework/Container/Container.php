<?php

namespace Moofik\Framework\Container;

class Container
{
    /**
     * @var array
     */
    private $storage;

    /**
     * @param string $id
     * @return mixed
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            return $this->storage[$id];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->storage[$id]);
    }

    /**
     * @param string $signature
     * @param string $actualClass
     */
    public function setClass(string $signature, string $actualClass): void
    {
        $this->storage[$signature] = $actualClass;
    }

    /**
     * @param string $signature
     * @param $instance
     */
    public function setInstance(string $signature, $instance): void
    {
        $this->storage[$signature] = $instance;
    }

    /**
     * @param string $signature
     * @param \Closure $closure
     */
    public function setClosure(string $signature, \Closure $closure): void
    {
        $this->storage[$signature] = $closure;
    }
}