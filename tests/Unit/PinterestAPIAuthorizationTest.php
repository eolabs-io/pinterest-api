<?php

namespace EolabsIo\PinterestApi\Tests\Unit;

use EolabsIo\PinterestApi\Tests\Unit\BaseModelTest;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

class PinterestAPIAuthorizationTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PinterestApiAuthorization::class;
    }
}
