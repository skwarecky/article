<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssetCollectionResource;
use App\Models\Asset;
use App\Repositories\AssetRepository;
use App\Services\Asset\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller
{

	public function __construct(
		private Service $service,
		private AssetRepository $assetRepository

	){
	}

	public function index(){
		$assets = AssetCollectionResource::collection(
			$this->assetRepository->paginated()
		);

		return Inertia::render('Asset/Index', ['assets' => $assets]);
	}

	public function show(Asset $asset){
		return Inertia::render('Asset/Show', ['asset' => $asset]);
	}

	public function create(){
		return Inertia::render('Asset/Create');
	}

	public function store(Request $request){
		if($this->service->create($request)){
			return redirect()->route('asset.index')->with('success', 'Create asset successfully');
		}
		return redirect()->route('asset.index')->with('error', 'Error');
	}

	public function destroy(Asset $asset){
		if($this->service->destroy($asset)){
			return redirect()->route('asset.index')->with('success', 'Deleted asset successfully');
		}
		return redirect()->route('asset.index')->with('error', 'Error while deleting asset');
	}

	public function download(Asset $asset)
	{
		return Storage::disk(Service::PUBLIC)->download($asset->path);
	}
}
