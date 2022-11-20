<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

	/**
	 * Table name
	 * @var string
	 */
	protected $table = 'articles';

	/**
	 * The attributes that are mass assignable.
	 * @var string[]
	 */
	protected $fillable = [
		'user_id',
		'title',
		'content',
	];

	/**
	 * The attributes that should be cast.
	 * @var array<string, string>
	 */
	protected $casts = [
		'created_at' => 'datetime:Y-m-d h:m:s',
		'updated_at' => 'datetime:Y-m-d h:m:s',
	];

	/**
	 * Scope for authors articles
	 */
	protected static function boot()
	{
		parent::boot();

		if(auth()->user()->is_editor){
			return;
		}

		static::addGlobalScope('article_author', function (Builder  $builder) {
			$builder->where('articles.user_id', auth()->user()->id);
		});
	}


	/**
	 * Relation articles.user_id = users.id
	 * @return BelongsTo
	 */
	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	/**
	 * Relations article.id = article_asset.asset_id
	 * @return HasMany
	 */
	public function articleAsset(): HasMany {
		return $this->hasMany(
			ArticleAsset::class,
		);
	}
}
