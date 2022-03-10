<?php

namespace EolabsIo\PinterestApi\Database\Factories;

use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;
use EolabsIo\PinterestApi\Domain\Shared\Models\Campaign;
use EolabsIo\PinterestApi\Domain\AdAccounts\Models\CostInsight;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\PinterestApi\Domain\Reporting\Models\CostInsight>
 */
class CostInsightFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CostInsight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ad_account_id' => $this->faker->randomNumber(4),
            'ad_id' => Ad::factory(),
            'campaign_id' => Campaign::factory(),
            'ad_group_id' => AdGroup::factory(),
            'date' => $this->faker->date('Y-m-d'),
            'total_clickthrough' => $this->faker->randomNumber(),
            'spend' => $this->faker->randomFloat(2),
        ];
    }
}
