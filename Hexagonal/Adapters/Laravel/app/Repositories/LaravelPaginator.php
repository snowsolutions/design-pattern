<?php

namespace LaravelApp\Repositories;

use Domains\Util\PaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class LaravelPaginator implements PaginatorInterface
{
    public function __construct(
        private readonly LengthAwarePaginator $paginator
    )
    {
    }

    public function getData(): array
    {
        return $this->paginator->items();
    }

    public function getCurrentPage(): int
    {
        return $this->paginator->currentPage();
    }

    public function getPerPage(): int
    {
        return $this->paginator->perPage();
    }

    public function getTotal(): int
    {
        return $this->paginator->total();
    }
}
