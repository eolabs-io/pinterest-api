<?php
namespace EolabsIo\PinterestApi\Tests\Unit\Shared;

use EolabsIo\PinterestApi\Tests\Unit\BaseModelTest;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;

class AdSetTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return AdGroup::class;
    }
}
