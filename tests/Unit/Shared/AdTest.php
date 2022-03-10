<?php
namespace EolabsIo\PinterestApi\Tests\Unit\Shared;

use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use EolabsIo\PinterestApi\Tests\Unit\BaseModelTest;

class AdTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Ad::class;
    }
}
