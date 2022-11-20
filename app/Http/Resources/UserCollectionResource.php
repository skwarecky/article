<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollectionResource extends JsonResource
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
			'is_author' => data_get($this, 'is_author'),
			'is_editor' => data_get($this, 'is_editor'),
			'name' => data_get($this, 'name'),
			'email' => data_get($this, 'email'),
			'created_at' => data_get($this, 'created_at') ? data_get($this, 'created_at')->format('Y-m-d H:i:s') : '',
		];
    }

	private function getActions()
	{
		return [
			'edit_link' => route('user.edit', [ 'user' => data_get($this, 'id')]),
			'delete_link' => route('user.destroy', [ 'user' => data_get($this, 'id')])
		];
	}
}
