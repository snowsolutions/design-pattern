<?php

namespace App\Services\Delivery;


class GrabDeliveryService implements DeliveryServiceInterface
{

    public function deliver($address): void
    {
        echo "> > > > Deliver order with method Grab to address: $address\n";
    }
}