<?php
use SymfonyApp\Kernel as SymfonyKernel;
require_once "./Shared/service.php";
$features = get_features();
$targetFramework = $features['framework'];
switch ($targetFramework) {
    case 'laravel': {
        require_once __DIR__ . '/Adapters/Laravel/public/index.php';
        break;
    }
    case 'symfony': {
        require_once __DIR__ . '/Adapters/Symfony/vendor/autoload_runtime.php';
        return function (array $context) {
            return new SymfonyKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
        };
    }
}