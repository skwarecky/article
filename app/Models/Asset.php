<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

	/**
	 * Table name
	 * @var string
	 */
	protected $table = 'assets';

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'user_id',
		'title',
		'name',
		'extension',
		'path',
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
