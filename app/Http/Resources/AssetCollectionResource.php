<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			'actions' => $this->getActions(),
			'id' => data_get($this, 'id'),
			'title' => data_get($this, 'title'),
			'name' => data_get($this, 'name'),
			'extension' => data_get($this, 'extension'),
			'created_at' => data_get($this, 'created_at') ? data_get($this, 'created_at')->format('Y-m-d H:i:s') : '',
		];
    }

	private function getActions()
	{
		return [
			'show_link' => route('asset.show', [ 'asset' => data_get($this, 'id')]),
			'delete_link' => route('asset.destroy', [ 'asset' => data_get($this, 'id')])
		];
	}
}
