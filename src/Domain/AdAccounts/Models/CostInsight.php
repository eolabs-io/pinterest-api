<?php

namespace EolabsIo\PinterestApi\Domain\AdAccounts\Models;

use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;
use EolabsIo\PinterestApi\Database\Factories\CostInsightFactory;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiModel;

class CostInsight extends PinterestApiModel
{

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pinterest_cost_insights';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_start' => 'date',
        'date_stop' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'ad_account_id',
                    'ad_id',
                    'campaign_id',
                    'ad_group_id',
                    'date',
                    'total_clickthrough',
                    'spend',
                ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withDefault();
    }

    public function adGroup()
    {
        return $this->belongsTo(AdGroup::class)->withDefault();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return CostInsightFactory::new();
    }
}
