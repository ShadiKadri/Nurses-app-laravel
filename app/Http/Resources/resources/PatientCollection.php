<?php

namespace App\Http\Resources\resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientCollection extends ResourceCollection
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
                    'user_id'   => (int) $data->user_id,
                    'room_photo' => asset('images') ."/". $data->room_photo,
                    'is_stopped' => $data->is_stopped,
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
