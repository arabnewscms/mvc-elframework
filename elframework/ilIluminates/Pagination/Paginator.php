<?php

namespace Iliuminates\Pagination;

use Iliuminates\Database\Queries\Collection;
use IteratorAggregate;
use Traversable;

class Paginator implements IteratorAggregate
{
    protected int $totalPages;

    public function __construct(protected ?Collection $data, protected int $total, protected int $currentPage, protected int $perPage)
    {
        $this->totalPages = (int) ceil($this->total / $this->perPage);
    }

    public function getIterator(): Traversable
    {
        return $this->data??new Collection([]);
    }


    public function getData(): Collection
    {
        return $this->data ?? new Collection([]);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->totalPages;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }
}
