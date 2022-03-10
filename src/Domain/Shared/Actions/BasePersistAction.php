<?php

namespace EolabsIo\PinterestApi\Domain\Shared\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\PinterestApi\Domain\Shared\Concerns\FormatsModelAttributes;

abstract class BasePersistAction
{
    use FormatsModelAttributes;

    /** @var array */
    protected $list;

    public function __construct($list)
    {
        $key = $this->getKey();
        $this->list = data_get($list, $key, []);
    }

    abstract public function getKey(): string;

    public function execute()
    {
        ($this->shouldCreateFromList()) ? $this->createFromList() : $this->create();
    }

    private function createFromList()
    {
        foreach ($this->list as $value) {
            $item = $this->createItem($value);

            $this->firePersistedActionEvent($item);
        }
    }

    private function create()
    {
        $item = $this->createItem($this->list);

        $this->firePersistedActionEvent($item);
    }

    abstract protected function createItem($list): Model;

    private function firePersistedActionEvent(Model $item)
    {
        $event = $this->getPersistedEvent();
        if (is_null($event)) {
            return;
        }

        $event::dispatch($item);
    }

    public function getPersistedEvent()
    {
        return null;
    }

    public function shouldCreateFromList(): bool
    {
        return true;
    }
}
