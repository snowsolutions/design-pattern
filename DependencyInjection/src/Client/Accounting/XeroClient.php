<?php

namespace App\Client\Accounting;

class XeroClient implements AccountingClientInterface
{

    public function getInvoices(): array
    {
        echo "> > getting invoices from Xero...\n";
        return [
            '0' => 'Invoice #001 from Xero',
            '1' => 'Invoice #002 from Xero',
            '2' => 'Invoice #003 from Xero',
            '3' => 'Invoice #004 from Xero',
        ];
    }
}