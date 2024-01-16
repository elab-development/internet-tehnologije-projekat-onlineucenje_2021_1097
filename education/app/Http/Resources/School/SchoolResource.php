<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'school';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'address' => $this->resource->address . ", " . $this->resource->city . ", " . $this->resource->country,
            'founded in' => $this->resource->founded
        ];
    }
}
