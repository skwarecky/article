<?php

namespace Tests\Unit\Service;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\User;
use App\Services\Article\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ArticleTest extends TestCase
{
	use RefreshDatabase;
	private Service $service;

	public function setUp(): void
	{
		parent::setUp();
		$this->service = new Service();
	}

	public function testCreateArticle(): void
	{
		$user = User::factory()->create();
		$countUserArticles = Article::where('user_id', $user->id)->count();


		self::assertEquals(0, $countUserArticles);

		$this->actingAs($user);

		$request = new ArticleStoreRequest();
		$request->replace([
			'title' => fake()->sentence(),
			'content' => fake()->sentence(),
		]);

		$this->service->create($request);
		$countUserArticles = Article::where('user_id', $user->id)->count();


		self::assertEquals(1, $countUserArticles);
	}


	public function testUpdateArticle(): void
	{

		$user = User::factory()->create();
		$countUserArticles = Article::where('user_id', $user->id)->count();


		self::assertEquals(0, $countUserArticles);

		$article = Article::factory()->create(['user_id' => $user->id]);

		$this->actingAs($user);

		$request = new ArticleUpdateRequest();
		$request->replace([
			'title' => fake()->sentence(),
			'content' => fake()->sentence(),
		]);

		self::assertTrue($this->service->update($article, $request));

	}

}
