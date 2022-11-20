<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleAsset;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleAssetFactory extends Factory
{
	/**
	 * Name of model
	 * @var string
	 */
	protected $model = ArticleAsset::class;
	/**
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
	{
        return [
			'article_id' => Article::factory(),
			'asset_id' => Asset::factory(),
        ];
    }
}
