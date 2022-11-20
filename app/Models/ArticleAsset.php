<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleAsset extends Model
{
    use HasFactory;

	/**
	 * The table name
	 * @var string
	 */
	protected $table = 'article_asset';

	/**
	 * Turn off timestamps
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'article_id',
		'asset_id',
	];

}
