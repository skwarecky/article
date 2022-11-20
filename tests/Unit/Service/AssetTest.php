<?php

namespace Tests\Unit\Service;

use App\Models\Asset;
use App\Models\User;
use App\Services\Asset\Service;
use Database\Factories\AssetFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Str;
use Tests\TestCase;

class AssetTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

	private Service $service;

	public function setUp(): void
	{
		parent::setUp();
		$this->service = new Service();
	}

	public function testCreateArticle(): void
	{
		$user = User::factory()->create();
		$countUserArticles = Asset::where('user_id', $user->id)->count();


		self::assertEquals(0, $countUserArticles);

		$this->actingAs($user);

		$name = Str::random(8).'.png';
		$path = 'storage/app/public/'.AssetFactory::EXAMPLE_FILE_PATH;


		$response = $this->post(route('asset.store'), [
			'title' => fake()->sentence(),
			'file' => new UploadedFile($path, $name, 'image/png', null, true),
		]);

		$countUserArticles = Asset::where('user_id', $user->id)->count();


		self::assertEquals(1, $countUserArticles);
	}

}
