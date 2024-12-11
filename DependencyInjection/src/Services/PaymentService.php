<?php

namespace App\Services;

use App\Factory\PaymentFactory;

class PaymentService
{
    public function __construct(
        private readonly PaymentFactory $paymentFactory
    )
    {

    }

    public function makePayment(array $data)
    {
        $paymentType = $data['type'];
        $paymentAmount = $data['amount'];
        echo "> > > PaymentService\n";
        $paymentService = $this->paymentFactory->create($paymentType);
        $paymentService->pay($paymentAmount);
    }
}