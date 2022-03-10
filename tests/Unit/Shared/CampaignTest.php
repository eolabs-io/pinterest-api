<?php
namespace EolabsIo\PinterestApi\Tests\Unit\Shared;

use EolabsIo\PinterestApi\Tests\Unit\BaseModelTest;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;

class CampaignTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Campaign::class;
    }
}
