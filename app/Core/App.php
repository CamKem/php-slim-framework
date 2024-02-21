<?php

namespace app\Core;

class App
{
    protected static $container;

    public static function setContainer(Container $container): void
    {
        if (isset(static::$container)) {
            throw new \RuntimeException("Can't overwrite container instance");
        }

        static::$container = $container;
    }

    public static function container(): Container
    {
        if (!isset(static::$container)) {
            throw new \RuntimeException("No container instance set");
        }

        return static::$container;
    }

    public static function bind(string $key, callable $resolver): void
    {
        static::container()->bind($key, $resolver);
    }

    public static function resolve(string $key)
    {
        return static::container()->resolve($key);
    }
}
