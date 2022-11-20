<?php

namespace Database\Seeders;

use App\Models\ArticleAsset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		ArticleAsset::factory(5)->create();
    }
}
