<?php

namespace App\Client\Accounting;

interface AccountingClientInterface
{
    public function getInvoices(): array;
}