<?php

namespace EolabsIo\PinterestApi\Support\Concerns;

use Illuminate\Support\Collection;

trait Paginatable
{
    /** @var array */
    private $pinterestPagination = [];

    public function checkForPagination(Collection $results): self
    {
        $bookmark = $results->get('bookmark');
        $this->setBookmark($bookmark);

        $pageSize = $results->get('page_size');
        $this->setPageSize($pageSize);

        return $this;
    }

    public function clearPagination(): self
    {
        $this->pinterestPagination = [];

        return $this;
    }

    public function getBookmark(): ?string
    {
        return data_get($this->pinterestPagination, 'bookmark');
    }

    public function setBookmark(string $bookmark = null): self
    {
        $this->pinterestPagination['bookmark'] = $bookmark;

        return $this;
    }

    public function hasBookmark(): bool
    {
        return filled($this->getBookmark());
    }

    public function getPageSize(): ?int
    {
        return data_get($this->pinterestPagination, 'page_size');
    }

    public function withPageSize(int $pageSize): self
    {
        return $this->setPageSize($pageSize);
    }

    public function setPageSize(?int $pageSize = null): self
    {
        if ($pageSize < 1) {
            $pageSize = 1;
        }

        if ($pageSize > 100) {
            $pageSize = 100;
        }

        $this->pinterestPagination['page_size'] = $pageSize;

        return $this;
    }

    public function hasPageSize(): bool
    {
        return filled($this->getPageSize());
    }

    public function hasPagination(): bool
    {
        return $this->hasBookmark();
    }

    public function getPaginationParameters(): array
    {
        return $this->pinterestPagination;
    }
}
