<?php

namespace EolabsIo\PinterestApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\PinterestApi\Domain\Shared\Models\AdGroup>
 */
class AdGroupFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4),
            'name' => $this->faker->text(),
        ];
    }
}
