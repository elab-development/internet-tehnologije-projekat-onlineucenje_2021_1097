<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\School\SchoolResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'course';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'professor' => $this->resource->professor,
            'school' => new SchoolResource($this->resource->school)
        ];
    }
}
