<?php

namespace App\Services;

class PurchaseService
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly DeliveryService $deliveryService,
        private readonly string $serviceName = "Generic purchase service",
        private array $sources = [],
    )
    {
    }

    public function setSources(array $sources): void
    {
        $this->sources = $sources;
    }

    public function purchase(array $purchaseData = [])
    {
        echo "> PurchaseService: {$this->serviceName}\n";
        foreach ($this->sources as $source) {
            echo "> Source: {$source}\n";
        }
        $paymentData = $purchaseData['payment'];
        $deliveryData = $purchaseData['delivery'];
        $productsData = $purchaseData['products'];
        $orderData = [
            'payment' => $paymentData,
            'products' => $productsData,
        ];
        $this->orderService->makeOrder($orderData);
        $this->deliveryService->deliver($deliveryData);
    }
}