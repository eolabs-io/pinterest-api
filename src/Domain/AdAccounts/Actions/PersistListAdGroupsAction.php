<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\PinterestApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;

class PersistListAdGroupsAction extends BasePersistAction
{
    public function getKey(): string
    {
        return 'items';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new AdGroup);

        $attributes = [
            'id' => data_get($list, 'id'),
        ];

        $adGroup = AdGroup::updateOrCreate($attributes, $values);

        return $adGroup;
    }
}
