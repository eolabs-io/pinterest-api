<?php

namespace EolabsIo\PinterestApi\Domain\Shared\Models;

use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiModel;
use EolabsIo\PinterestApi\Database\Factories\PinterestApiAuthorizationFactory;

class PinterestApiAuthorization extends PinterestApiModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pinterest_api_authorizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'client_id',
                    'scope',
                    'refresh_token',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PinterestApiAuthorizationFactory::new();
    }
}
