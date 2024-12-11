<?php

declare(strict_types=1);

namespace Framework;

class ContextualMapper
{
    public static function getRealClass(string $interface, array $contextClasses = []): ?string
    {
        $lastMatch = null;
        $contextualMap = (require __DIR__ . "/../config/di.php");
        $classMap = $contextualMap[$interface];
        $matches = array_filter(array_keys($classMap), static fn ($context) => in_array($context, $contextClasses));
        return $classMap[end($matches)];
    }
}