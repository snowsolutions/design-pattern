<?php

namespace Domains\Util;

interface PaginatorInterface
{
    public function getData(): array;
    public function getCurrentPage(): int;
    public function getPerPage(): int;
    public function getTotal(): int;
}
