<?php

namespace EolabsIo\PinterestApi\Database\Factories;

use EolabsIo\PinterestApi\Domain\Shared\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\PinterestApi\Domain\Shared\Models\Ad>
 */
class AdFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ad::class;

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
