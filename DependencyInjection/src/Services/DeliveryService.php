<?php

namespace App\Services;

use App\Factory\DeliveryFactory;

class DeliveryService
{
    public function __construct(
        private readonly DeliveryFactory $deliveryFactory
    )
    {

    }

    public function deliver($deliveryData)
    {
        echo "> > DeliveryService\n";
        $type = $deliveryData['type'];
        $address = $deliveryData['address'];
        $deliveryService = $this->deliveryFactory->create($type);
        $deliveryService->deliver($address);
    }
}