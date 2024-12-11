<?php

namespace App\Factory;

use App\Services\Payment\MomoPaymentService;
use App\Services\Payment\PaymentServiceInterface;
use App\Services\Payment\VietQrPaymentService;

class PaymentFactory
{
    public function create($type): PaymentServiceInterface
    {
        echo "> > > > PaymentFactory\n";
        return match ($type) {
            'momo' => new MomoPaymentService(),
            'viet_qr' => new VietQrPaymentService(),
            default => throw new \InvalidArgumentException("Invalid payment type $type"),
        };
    }
}