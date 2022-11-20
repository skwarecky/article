<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
	/**
	 * Name of model
	 * @var string
	 */
	protected $model = Article::class;
	/**
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
			'content' => fake()->sentence(),
        ];
    }
}
