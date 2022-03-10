<?php
namespace EolabsIo\PinterestApi\Domain\Shared\Models;

use EolabsIo\PinterestApi\Database\Factories\AdFactory;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiModel;

class Ad extends PinterestApiModel
{
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pinterest_ads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'id',
                    'name',
                ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return AdFactory::new();
    }
}
