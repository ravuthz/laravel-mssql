<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'room_name' => $this->room_name,
            'room_type' => $this->room_type,
            'num_member' => $this->num_member,
            'equipment' => $this->equipment,
            'description' => $this->description,
            'modified_dt' => (string) $this->modified_dt,
        ];
    }

    public function with($request)
    {
        return [
            'statusCode' => response()->json()->getStatusCode(),
        ];
    }
}
