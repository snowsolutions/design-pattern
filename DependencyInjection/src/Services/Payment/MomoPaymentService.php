<?php

namespace App\Services\Payment;

class MomoPaymentService implements PaymentServiceInterface
{
    public function pay($paymentAmount)
    {
        echo "> > > > Capturing $paymentAmount with Momo payment\n";
    }
}