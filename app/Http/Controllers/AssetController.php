<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetStoreRequest;
use App\Http\Resources\AssetCollectionResource;
use App\Models\Asset;
use App\Repositories\AssetRepository;
use App\Services\Asset\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller
{

	/**
	 * @param Service $service
	 * @param AssetRepository $assetRepository
	 */
	public function __construct(
		private Service $service,
		private AssetRepository $assetRepository

	){
	}

	/**
	 * View assets
	 * @return Response
	 */
	public function index(): Response
	{
		$assets = AssetCollectionResource::collection(
			$this->assetRepository->paginated()
		);

		return Inertia::render('Asset/Index', ['assets' => $assets]);
	}

	/**
	 * Show asset
	 * @param Asset $asset
	 * @return Response
	 */
	public function show(Asset $asset) : Response
	{
		return Inertia::render('Asset/Show', ['asset' => $asset]);
	}

	/**
	 * Create asset view
	 * @return Response
	 */
	public function create(): Response
	{
		return Inertia::render('Asset/Create');
	}

	/**
	 * Store uploaded asset
	 * @param AssetStoreRequest $request
	 * @return RedirectResponse
	 */
	public function store(AssetStoreRequest $request): RedirectResponse
	{
		if($this->service->create($request)){
			return redirect()->route('asset.index')->with('success', 'Create asset successfully');
		}
		return redirect()->route('asset.index')->with('error', 'Error');
	}

	/**
	 * Delete specific asset
	 * @param Asset $asset
	 * @return RedirectResponse
	 */
	public function destroy(Asset $asset): RedirectResponse
	{
		if($this->service->destroy($asset)){
			return redirect()->route('asset.index')->with('success', 'Deleted asset successfully');
		}
		return redirect()->route('asset.index')->with('error', 'Error while deleting asset');
	}

	/**
	 * Download asset
	 * @param Asset $asset
	 * @return StreamedResponse
	 */
	public function download(Asset $asset): StreamedResponse
	{
		return Storage::disk(Service::PUBLIC)->download($asset->path);
	}
}
