<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

	/**
	 * Relation article_asset.asset_id = assets.id
	 * @return BelongsTo
	 */
	public function asset(): BelongsTo
	{
		return $this->belongsTo(Asset::class);
	}

	/**
	 * Relation article_asset.article_id = articles.id
	 * @return BelongsTo
	 */
	public function article(): BelongsTo
	{
		return $this->belongsTo(Article::class);
	}
}
