<?php
use SymfonyApp\Kernel as SymfonyKernel;
require_once "./Shared/service.php";
// Unregister all root autoloader
$features = get_features();
$targetFramework = 'symfony';
switch ($targetFramework) {
    case 'laravel': {
        require_once __DIR__ . '/Ports/Laravel/public/index.php';
        break;
    }
    case 'symfony': {
        require_once __DIR__ . '/Ports/Symfony/vendor/autoload_runtime.php';
        return function (array $context) {
            return new SymfonyKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
        };
    }
}