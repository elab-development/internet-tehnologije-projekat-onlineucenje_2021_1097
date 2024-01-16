<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\School\SchoolResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'student';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'gender' => $this->resource->gender,
            'birth' => $this->resource->birth,
            'studies' => $this->resource->course->name,
            'at' => new SchoolResource($this->resource->course->school)
        ];
    }
}
