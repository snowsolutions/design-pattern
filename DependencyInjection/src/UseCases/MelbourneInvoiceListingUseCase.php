<?php

namespace App\UseCases;

use App\Services\AccountingService;

class MelbourneInvoiceListingUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly AccountingService $accountingService,
    )
    {

    }

    public function execute(): array
    {
        echo "> Executing use case MelbourneInvoiceListing\n";
        return $this->accountingService->getInvoices();
    }
}