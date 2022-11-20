<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{

	public function own(User $user, Article $article){
		return $article->user->is($user);
	}

	public function ownOrEditor(User $user, Article $article){
		if($user->is_author){
			return $article->user->is($user);
		}
		if($user->is_editor){
			return true;
		}
	}
}
