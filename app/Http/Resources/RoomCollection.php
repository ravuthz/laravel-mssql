<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        // return RoomResource::collection($this->collection);
        return $this->collection->transform(function ($room) {
            return [
                'room_name' => $room->room_name,
                'room_type' => $room->room_type,
                'num_member' => $room->num_member,
                'equipment' => $room->equipment,
                'description' => $room->description,
                'modified_dt' => (string) $room->modified_dt,
                'schedules' => new ScheduleCollection($room->schedules),
            ];
        });
    }

    public function with($request)
    {
        return [
            'statusCode' => response()->json()->getStatusCode(),
        ];
    }
}
