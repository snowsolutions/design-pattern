<?php

namespace App\Services;

use App\Client\Accounting\AccountingClientInterface;

class AccountingService
{
    public function __construct(
        private readonly AccountingClientInterface $accountingClient
    )
    {

    }

    public function getInvoices(): array
    {
        return $this->accountingClient->getInvoices();
    }
}