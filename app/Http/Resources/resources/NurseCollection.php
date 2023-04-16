<?php

namespace App\Http\Resources\resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NurseCollection extends ResourceCollection
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
                    'user_id'   => (int) $data->user_id,
                    'name' => $data->name,
                    'gender' => $data->gender,
                    'phone_number' => $data->phone,
                    'is_resigned' => $data->is_resigned,
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
