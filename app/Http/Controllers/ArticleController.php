<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Resources\ArticleAssetCollectionResource;
use App\Http\Resources\ArticleCollectionResource;
use App\Http\Resources\AssetSelectCollectionResource;
use App\Models\Article;
use App\Repositories\ArticleAssetRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\AssetRepository;
use App\Services\Article\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{


	public function __construct(
		private Service $service,
		private ArticleRepository $articleRepository,
		private AssetRepository $assetRepository,
		private ArticleAssetRepository $articleAssetRepository

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

		$assets = AssetSelectCollectionResource::collection(
			$this->assetRepository->getAll()
		);


		return Inertia::render('Article/Create', ['assets' => $assets]);
	}

	public function store(ArticleStoreRequest $request){
		if($this->service->create($request)){
			return redirect()->route('article.index')->with('success', 'Create article successfully');
		}
		return redirect()->route('article.index')->with('error', 'Error');
	}

	public function edit(Article $article){
		$this->authorize('own', $article);

		$assets = AssetSelectCollectionResource::collection(
			$this->assetRepository->getAll()
		);

		$articleAssets = ArticleAssetCollectionResource::collection(
			$this->articleAssetRepository->getById(data_get($article, 'id'))
		);

		return Inertia::render('Article/Edit',[
			'article' => $article,
			'assets' => $assets,
			'articleAssets' => $articleAssets
		]);
	}

	public function update(Article $article, ArticleUpdateRequest $request){
		$this->authorize('own', $article);

		if($this->service->update($article, $request)){
			return redirect()->route('article.index')->with('message','Create article successfully');
		}
		return redirect()->route('article.index')->with('message','Error');

	}


	public function destroy(Article $article){
		$this->authorize('own', $article);

		$article->delete();

		return redirect()->back()->with('success', 'Delete article successfully');
	}
}
