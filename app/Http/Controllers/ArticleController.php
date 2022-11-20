<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollectionResource;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Services\Article\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{


	public function __construct(
		private Service $service,
		private ArticleRepository $articleRepository

	){
	}

	public function index(){
		$articles = ArticleCollectionResource::collection(
			$this->articleRepository->paginated()
		);


		return Inertia::render('Article/Index', ['articles' => $articles]);
	}

	public function show(Article $article){
		return Inertia::render('Article/Show', ['article'=> $article]);
	}


	public function create(){
		return Inertia::render('Article/Create');
	}

	public function store(Request $request){
		if($this->service->create($request)){
			return redirect()->route('article.index')->with('success', 'Create article successfully');
		}
		return redirect()->route('article.index')->with('error', 'Error');
	}

	public function edit(Article $article){
		$this->authorize('own', $article);

		return Inertia::render('Article/Edit',[
			'article' => $article
		]);
	}

	public function update(Article $article, Request $request){
		$this->authorize('own', $article);

		if($this->service->update($article, $request)){
			return redirect()->route('article.index')->with('success', 'Create article successfully');
		}
		return redirect()->route('article.index')->with('error', 'Error');

	}
	public function destroy(Article $article){
		$this->authorize('own', $article);

		$article->delete();

		return redirect()->back()->with('success', 'Delete article successfully');
	}
}