<?php
return [
    'App\Client\Accounting\AccountingClientInterface' => [
        'App\UseCases\VictoriaInvoiceListingUseCase' => 'App\Client\Accounting\XeroClient',
        'App\UseCases\MelbourneInvoiceListingUseCase' => 'App\Client\Accounting\MyObClient'
    ],
];