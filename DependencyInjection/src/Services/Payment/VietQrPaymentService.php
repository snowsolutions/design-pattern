<?php

namespace App\Services\Payment;

class VietQrPaymentService implements PaymentServiceInterface
{
    public function pay($paymentAmount)
    {
        echo "> > > > Capturing $paymentAmount with VietQR payment\n";
    }
}