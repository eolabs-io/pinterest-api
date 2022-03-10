<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use EolabsIo\PinterestApi\Domain\Shared\Actions\BasePersistAction;

class PersistListAdsAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'items';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Ad);

        $attributes = [
            'id' => data_get($list, 'id'),
        ];

        $ad = Ad::updateOrCreate($attributes, $values);

        return $ad;
    }
}
