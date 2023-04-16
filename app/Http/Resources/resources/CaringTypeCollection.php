<?php

namespace App\Http\Resources\resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CaringTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id'   => (int) $data->id,
                    'name' => $data->name,
                    'desciption' => $data->description
                ];
            })
        ];
    }



    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
