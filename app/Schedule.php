<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'event_id';
    protected $table = "mrm_meeting_schedule";
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'modified_dt';

    protected $fillable = [
        "start_date",
        "end_date",
        "subjects",
        "start_time",
        "end_time",
        "room_id",
        "requestedby",
        "leadby",
        "recordedby",
        "mr_id",
        "num_member",
        "description",
        "result",
        "recordedby",
        "status",
        "status_comment",
    ];
}
