<?php

namespace App\Services\Delivery;

interface DeliveryServiceInterface {
    public function deliver($address): void;
}