<?php

namespace app\Core;

use Exception;

class Container
{
    protected array $singletonBindings = [];
    protected array $singletonInstances = [];
    protected array $bindings = [];

    public function bind($key, $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function singleton($key, $resolver): void
    {
        $this->singletonBindings[$key] = $resolver;
        $this->singletonInstances[$key] = null;
    }

    /**
     * @throws Exception
     */
    public function resolve($key): mixed
    {
        if (array_key_exists($key, $this->singletonBindings)) {
            if ($this->singletonInstances[$key] !== null) {
                return $this->singletonInstances[$key];
            }

            $resolver = $this->singletonBindings[$key];
            $this->singletonInstances[$key] = $resolver();

            return $this->singletonInstances[$key];
        }

        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            return $resolver();
        }

        throw new Exception("No matching binding found for {$key}");
    }
}