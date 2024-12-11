<?php

/**
 * This is the entrypoint to demo the design pattern
 */
require_once './vendor/autoload.php';

use App\Services\PurchaseService;
use Framework\AppContainer;

$container = new AppContainer();

/**
 * @var $purchaseService PurchaseService
 */
$purchaseService = $container->get(PurchaseService::class);

$purchaseService->setSources(
    [
        'Shopee',
        'Lazada',
        'Taotao',
        'Alibaba',
        'Temu',
    ]
);

$purchaseService->purchase([
    'products' => [
        [
            'name' => 'Food'
        ],
        [
            'name' => 'Electronic'
        ]
    ],
    'delivery' => [
        'type' => 'grab',
        'address' => '123 Sample Street, Virtual City, Non-exist Country'
    ],
    'payment' => [
        'type' => 'momo',
        'amount' => '10.00',
    ]
]);