<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AssetFactory extends Factory
{

	/**
	 * Name of model
	 * @var string
	 */
	protected $model = Asset::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
	{
        return [
			'user_id' => User::factory(),
			'title' => fake()->sentence(),
			'name' => fake()->sentence(),
			'extension' => fake()->sentence(),
			'path' => fake()->url()
        ];
    }
}
