<?php

declare(strict_types=1);

namespace Framework;

class AppContainer
{
    private static $cache = [];

    /**
     * @throws \Exception
     */
    public function get($className)
    {
        if (!class_exists($className)) {
            throw new \Exception("Class $className does not exist");
        }
        /**
         * Return the instance if the class name is found in container cache
         */
        if (isset(static::$cache[$className])) {
            return static::$cache[$className];
        }
        return DependencyResolver::resolve($className, $cache);
    }
}