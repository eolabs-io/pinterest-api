<?php

namespace EolabsIo\PinterestApi\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class PinterestApiModel extends Model
{
    use HasFactory;

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('pinterest-api.database.connection') ?? $this->connection;
    }
}
