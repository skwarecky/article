<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
