<?php

namespace App\Client\Accounting;

class MyObClient implements AccountingClientInterface
{

    public function getInvoices(): array
    {
        echo "> > getting invoices from MyOb...\n";
        return [
            '0' => 'Invoice #001 from MyOb',
            '1' => 'Invoice #002 from MyOb',
            '2' => 'Invoice #003 from MyOb',
            '3' => 'Invoice #004 from MyOb',
        ];
    }
}