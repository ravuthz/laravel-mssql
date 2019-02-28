<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Lukasoppermann\Httpstatus\Httpstatus;

class ScheduleResource extends JsonResource
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
            "subjects" => $this->subjects,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "sedate" => $this->sedate,
            "setime" => $this->setime,
            "requestedby" => $this->requestedby,
            "leadby" => $this->leadby,
            "recordedby" => $this->recordedby,
            "mr_id" => $this->mr_id,
            "num_member" => $this->num_member,
            "description" => $this->description,
            "result" => $this->result,
            "recordedby" => $this->recordedby,
            "status" => $this->status,
            "status_comment" => $this->status_comment,
            // "room_id" => $this->room_id,
            "room" => $this->room,

        ];
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
