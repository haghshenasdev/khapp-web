<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class hadisresource extends JsonResource
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
            'ghala'=> $this->ghala,
            'arabi' => $this->arabi,
            'farsi' => $this->farsi
        ];
    }
}
