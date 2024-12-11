<?php

/**
 * This is the entrypoint to demo the design pattern
 */
require_once './vendor/autoload.php';

use App\UseCases\MelbourneInvoiceListingUseCase;
use App\UseCases\VictoriaInvoiceListingUseCase;
use Framework\AppContainer;

$container = new AppContainer();

$useCaseClasses = [
    MelbourneInvoiceListingUseCase::class, /** Getting data from MyOb */
    VictoriaInvoiceListingUseCase::class, /** Getting data from Xero */
];

foreach ($useCaseClasses as $useCaseClass) {
    /** @var \App\UseCases\UseCaseInterface $useCase */
    $useCase = $container->get($useCaseClass);
    $result = $useCase->execute();
    array_walk($result, function (&$item) {
        echo "> > > $item\n";
    });
}