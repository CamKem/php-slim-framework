<?php

namespace app\Core;

use RuntimeException;

class Container
{
    protected static self $instance;
    protected array $singletonBindings = [];
    protected array $singletonInstances = [];
    protected array $bindings = [];

    public function bind($key, $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function unbind($key): void
    {
        if (array_key_exists($key, $this->bindings)) {
            unset($this->bindings[$key]);
        }
    }

    public function singleton($key, $resolver): void
    {
        $this->singletonBindings[$key] = $resolver;
        $this->singletonInstances[$key] = null;
    }

    // TODO flattern the singletonInstances & singletonBindings.
    //  to be stored in the bindings array. Like this:
    //  $this->bindings[$key] = $resolver;
    //  Similar to the way laravel does it, bindings are the just used to store implementations.
    //  eg: abstracts => concrete implementations.

    /**
     * @param $key
     * @return object
     */
    public function resolve($key): object
    {
        if (array_key_exists($key, $this->singletonBindings)) {
            if ($this->singletonInstances[$key] !== null) {
                // return the actual singleton instance, not the array, so it's return the resolved instance

                return $this->singletonInstances[$key];
            }

            $resolver = $this->singletonBindings[$key];

            // check the resolver is a valid callable class
            if (!is_callable($resolver)) {
                if (!class_exists($resolver)) {
                    throw new RuntimeException("Resolver for {$key} is not a valid class.");
                }
                throw new RuntimeException("Resolver for {$key} is not a valid callable.");
            }

            $this->singletonInstances[$key] = $resolver();

            return $this->singletonInstances[$key];
        }

        if (array_key_exists($key, $this->bindings)) {
            $resolver = $this->bindings[$key];
            return $resolver();
        }

        throw new RuntimeException("No matching binding found for {$key}");
    }

    public static function getContainer(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function setContainer(self $container): self
    {
        return self::$instance = $container;
    }


}