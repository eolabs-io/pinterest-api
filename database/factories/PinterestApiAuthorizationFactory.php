<?php

namespace EolabsIo\PinterestApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization>
 */
class PinterestApiAuthorizationFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PinterestApiAuthorization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->sha1,
            'scope' => $this->faker->randomNumber(9, true),
            'refresh_token' => "pinr|{$this->faker->sha256}",
        ];
    }
}
