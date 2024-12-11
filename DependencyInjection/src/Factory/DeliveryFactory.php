<?php

namespace App\Factory;

use App\Services\Delivery\DeliveryServiceInterface;
use App\Services\Delivery\GrabDeliveryService;
use App\Services\Delivery\ShopeeDeliveryService;

class DeliveryFactory
{
    public function create($type): DeliveryServiceInterface
    {
        echo "> > > DeliveryFactory\n";
        return match ($type) {
            'grab' => new GrabDeliveryService(),
            'shopee' => new ShopeeDeliveryService(),
            default => throw new \InvalidArgumentException("Invalid delivery type $type"),
        };
    }
}