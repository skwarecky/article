<?php

namespace App\Services\Asset;

use App\Models\Asset;
use Illuminate\Support\Facades\Storage;
use Str;

class Service
{
	public const PUBLIC = 'public';
	public const FOLDER_PATH = 'assets/';

	public function create(\Illuminate\Http\Request $request)
	{
		$file = $request->file('file');
		$filePath =  Str::random(40);
		$fileExtension = $file->getClientOriginalExtension();
		$path = self::FOLDER_PATH.$filePath.'.'.$fileExtension;

		Storage::disk(self::PUBLIC)->put($path, file_get_contents($file));

		return Asset::create([
			'user_id' => data_get(auth()->user(), 'id'),
			'title' => data_get($request, 'title'),
			'name' => $file->getClientOriginalName(),
			'extension' => $file->getClientOriginalExtension(),
			'path' => $path
		]);
	}

	public function getById(int $id)
	{
		return Asset::firstOrFail($id);
	}

	public function destroy(Asset $asset)
	{

		if(!Storage::exists($asset->path)) {
			return false;
		}

		Storage::delete($asset->path);

		return $asset->delete();
	}
}
