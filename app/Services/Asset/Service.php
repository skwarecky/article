<?php

namespace App\Services\Asset;

use App\Http\Requests\AssetStoreRequest;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;
use Str;

class Service
{
	/**
	 * Default used disk
	 */
	public const PUBLIC = 'public';

	/**
	 * Default storage folder path
	 */
	public const FOLDER_PATH = 'assets/';


	/**
	 * Add new file asset
	 * @param AssetStoreRequest $request
	 * @return mixed
	 */
	public function create(AssetStoreRequest $request): mixed
	{
		$fileData = $this->storeFile($request->file('file'));

		return Asset::create([
			'user_id' => data_get(auth()->user(), 'id'),
			'title' => data_get($request, 'title'),
			'name' => data_get($fileData, 'fileName'),
			'extension' => data_get($fileData, 'fileExtension'),
			'path' => data_get($fileData, 'path'),
		]);
	}

	/**
	 * Destroy specific file if exists
	 * @param Asset $asset
	 * @return bool|null
	 */
	public function destroy(Asset $asset)
	{
		if(Storage::exists($asset->path)) {
			Storage::delete($asset->path);
		}

		return $asset->delete();
	}

	/**
	 * Save updated file
	 * @param $file
	 * @return array
	 */
	private function storeFile($file): array
	{
		$fileName =  Str::random(40);
		$fileExtension = $file->getClientOriginalExtension();
		$path = self::FOLDER_PATH.$fileName.'.'.$fileExtension;

		Storage::disk(self::PUBLIC)->put($path, file_get_contents($file));

		return [
			'fileName' => $fileName,
			'fileExtension' => $fileExtension,
			'path' => $path,
		];

	}
}
