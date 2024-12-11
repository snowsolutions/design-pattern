<?php

namespace App\Services;

class OrderService
{
    public function __construct(
        private readonly PaymentService $paymentService
    )
    {
    }

    public function makeOrder($orderData)
    {
        echo "> > OrderService\n";
        $this->paymentService->makePayment($orderData['payment']);
    }
}