<?php

namespace Tests\Feature\Article;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
	use RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();
		$this->withoutVite();
	}
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoggedUserArticleList()
    {
		$user = User::factory()->create();
		$this->actingAs($user);
        $response = $this->get('/asset');

		$response->assertSuccessful();
    }

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function testNotLoggedUserArticleList()
	{
		$response = $this->get('/asset');

		$response->assertStatus(302);
	}


	public function testLoggedUserArticleCreateView()
	{
		$user = User::factory()->create(['is_author' => true, 'is_editor' => false]);
		$this->actingAs($user);
		$response = $this->get('/article/create');

		$response->assertStatus(200);
	}

	public function testNotLoggedUserArticleCreateView()
	{
		$response = $this->get('/asset/create');

		$response->assertStatus(302);
	}

	public function testLoggedUserArticleStore()
	{
		$user = User::factory()->create(['is_author' => true, 'is_editor' => false]);
		$this->actingAs($user);
		$response = $this->post('/article', [
			'title' => fake()->sentence(),
			'content' => fake()->sentence()
		]);

		$response->assertStatus(302);
	}

	public function testNotLoggedUserArticleStore()
	{
		$response = $this->patch('/article/store', [
			'title' => fake()->sentence(),
			'content' => fake()->sentence()
		]);

		$response->assertStatus(302);
	}

	public function testLoggedUserArticleDelete()
	{
		$user = User::factory()->create();
		$article = Article::factory()->create(['user_id' => $user->id]);

		$this->actingAs($user);
		$response = $this->json('DELETE', route('article.destroy', ['article' => $article->id]));

		$response->assertStatus(302);

		$this->assertDatabaseCount('articles', 0);
	}

	public function testNotLoggedUserArticleDelete()
	{
		$article = Article::factory()->create();

		$response = $this->json('DELETE', route('article.destroy', ['article' => $article->id]));

		$response->assertStatus(401);

		$this->assertDatabaseCount('articles', 1);
	}
}
