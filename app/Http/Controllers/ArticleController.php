<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleAssetCollectionResource;
use App\Http\Resources\ArticleCollectionResource;
use App\Http\Resources\AssetSelectCollectionResource;
use App\Models\Article;
use App\Repositories\ArticleAssetRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\AssetRepository;
use App\Services\Article\Service;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class ArticleController extends Controller
{
	/**
	 * @param Service $service
	 * @param ArticleRepository $articleRepository
	 * @param AssetRepository $assetRepository
	 * @param ArticleAssetRepository $articleAssetRepository
	 */
	public function __construct(
		private Service $service,
		private ArticleRepository $articleRepository,
		private AssetRepository $assetRepository,
		private ArticleAssetRepository $articleAssetRepository
	){}

	/**
	 * @return \Inertia\Response
	 */
	public function index(){
		$articles = ArticleCollectionResource::collection(
			$this->articleRepository->paginated()
		);

		return Inertia::render('Article/Index', ['articles' => $articles]);
	}

	/**
	 * Show article
	 * @param Article $article
	 * @return \Inertia\Response
	 */
	public function show(Article $article){
		$articleAssets = ArticleAssetCollectionResource::collection(
			$this->articleAssetRepository->getById(data_get($article, 'id'))
		);

		return Inertia::render('Article/Show', ['article'=> $article, 'articleAssets' => $articleAssets]);
	}


	/**
	 * Create new article view
	 * @return \Inertia\Response
	 */
	public function create(){
		$this->authorize('create', auth()->user());

		$assets = AssetSelectCollectionResource::collection(
			$this->assetRepository->getAll()
		);

		return Inertia::render('Article/Create', ['assets' => $assets]);
	}

	/**
	 * Create new article
	 * @param ArticleStoreRequest $request
	 * @return RedirectResponse
	 */
	public function store(ArticleStoreRequest $request){
		$this->authorize('create', auth()->user());

		if($this->service->create($request)){
			return redirect()->route('article.index')->with('success', 'Create article successfully');
		}
		return redirect()->route('article.index')->with('error', 'Error');
	}


	/**
	 * Edit owned article
	 * @param Article $article
	 * @return \Inertia\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit(Article $article){
		$this->authorize('ownOrEditor', $article);

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


	/**
	 * Update owned article
	 * @param Article $article
	 * @param ArticleUpdateRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException\
	 */
	public function update(Article $article, ArticleUpdateRequest $request): RedirectResponse
	{
		$this->authorize('ownOrEditor', $article);

		if($this->service->update($article, $request)){
			return redirect()->route('article.index')->with('message','Create article successfully');
		}
		return redirect()->route('article.index')->with('message','Error');

	}


	/**
	 * Destroy article
	 * @param Article $article
	 * @return RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function destroy(Article $article): RedirectResponse
	{
		$this->authorize('own', $article);

		$article->delete();

		return redirect()->back()->with('success', 'Delete article successfully');
	}
}
