<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Lukasoppermann\Httpstatus\Httpstatus;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return [
                "event_id" => $item->event_id,
                "subjects" => $item->subjects,
                "start_date" => $item->start_date,
                "end_date" => $item->end_date,
                "start_time" => $item->start_time,
                "end_time" => $item->end_time,
                "sedate" => $item->sedate,
                "setime" => $item->setime,
                "requestedby" => $item->requestedby,
                "leadby" => $item->leadby,
                "recordedby" => $item->recordedby,
                "mr_id" => $item->mr_id,
                "num_member" => $item->num_member,
                "description" => $item->description,
                "result" => $item->result,
                "recordedby" => $item->recordedby,
                "status" => $item->status,
                "status_comment" => $item->status_comment,
                "room_name" => optional($item->room)->room_name,
                "room_id" => $this->room_id,
            ];
        });
    }

    public function with($request)
    {
        $httpStatus = new Httpstatus();
        $code = response()->json()->getStatusCode();
        return [
            'statusCode' => $code,
            'statusMessage' => $httpStatus->getReasonPhrase($code),
        ];
    }
}
