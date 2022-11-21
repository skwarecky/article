<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{

	/**
	 * check if user own article
	 * @param User $user
	 * @param Article $article
	 * @return mixed
	 */
	public function own(User $user, Article $article){
		return $article->user->is($user);
	}

	/**
	 * Check if user own article or is editor
	 * @param User $user
	 * @param Article $article
	 * @return bool
	 */
	public function ownOrEditor(User $user, Article $article): bool
	{
		if($user->is_author){
			return $article->user->is($user);
		}
		if($user->is_editor){
			return true;
		}

		return false;
	}

}
