<?php

namespace SymfonyApp;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Domains\Util\PaginatorInterface;

class SymfonyPaginator implements PaginatorInterface
{
    public function __construct(
        private readonly Paginator $paginator
    )
    {
    }

    public function getData(): array
    {
        return iterator_to_array($this->paginator);
    }

    public function getCurrentPage(): int
    {
        return $this->paginator->getQuery()->getFirstResult() / $this->paginator->getQuery()->getMaxResults() + 1;
    }

    public function getPerPage(): int
    {
        return $this->paginator->getQuery()->getMaxResults();
    }

    public function getTotal(): int
    {
        return $this->paginator->count();
    }
}