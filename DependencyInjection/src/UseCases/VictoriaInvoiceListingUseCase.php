<?php

namespace App\UseCases;

use App\Services\AccountingService;

class VictoriaInvoiceListingUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly AccountingService $accountingService,
    )
    {

    }

    public function execute(): array
    {
        echo "> Executing use case VictoriaInvoiceListing\n";
        return $this->accountingService->getInvoices();
    }
}