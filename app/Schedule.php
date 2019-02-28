<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'event_id';
    protected $table = "mrm_meeting_schedule";
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'modified_dt';

    protected $appends = ['sedate', 'setime'];

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

    public function getSedateAttribute($value)
    {
        $sdate = Carbon::parse($this->start_date)->format('m/d/Y');
        $edate = Carbon::parse($this->end_date)->format('m/d/Y');
        return "{$sdate} To {$edate}";
    }

    public function getSetimeAttribute($value)
    {
        return "{$this->start_time} - {$this->end_time}";
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

}
