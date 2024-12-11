<?php

declare(strict_types=1);

namespace Framework;

class DependencyResolver
{
    private static array $contextClasses = [];
    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public static function resolve($className, &$cache, $contextClasses = [])
    {
        /**
         * Detect circular injection
         */
        if (in_array($className, self::$contextClasses, true)) {
            throw new \Exception("Circular dependency detected for class '$className'. Resolution stack: " . implode(' -> ', self::$contextClasses));
        }

        $dependencies = [];
        self::$contextClasses[] = $className;
        $classReflection = new \ReflectionClass($className);

        /**
         * Use contextual mapping if an interface is injected
         */
        if ($classReflection->isInterface()) {
            $realClassName = ContextualMapper::getRealClass($className, $contextClasses);
            $dependencies[] = self::resolve($realClassName, $cache, self::$contextClasses);
            $className = $realClassName;
        }
        $constructor = $classReflection->getConstructor();
        /**
         * Return the instance if the class have no dependency
         */
        if (!$constructor) {
            $cache[$className] = new $className();
            array_pop(self::$contextClasses);
            return $cache[$className];
        }
        /**
         * Work out the class's dependencies
         */
        foreach ($constructor->getParameters() as $param) {
            $dependencyType = $param->getType();
            if (!$dependencyType || $dependencyType->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    $dependencies[] = $param->getDefaultValue();
                    continue;
                } else {
                    throw new \Exception("Cannot resolve scalar parameter '{$param->getName()}' in $className without default value.");
                }
            }
            $dependencyTypeName = $dependencyType->getName();
            $dependencies[] = self::resolve($dependencyTypeName, $cache, self::$contextClasses);
        }
        $cache[$className] = $classReflection->newInstanceArgs($dependencies);
        array_pop(self::$contextClasses);
        return $cache[$className];
    }
}