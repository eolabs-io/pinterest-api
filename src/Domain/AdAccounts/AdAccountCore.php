<?php
namespace EolabsIo\PinterestApi\Domain\AdAccounts;

use EolabsIo\PinterestApi\Domain\Shared\PinterestApiCore;

abstract class AdAccountCore extends PinterestApiCore
{
    public function __construct()
    {
        parent::__construct();

        $this->useGetMethod();
    }

    public function getVersion(): string
    {
        return 'v5';
    }

    public function getAdAccountId(): string
    {
        return config('pinterest-api.adAccountId');
    }
}
