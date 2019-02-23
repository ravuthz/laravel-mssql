<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'event_id';
    protected $table = "mrm_meeting_schedule";
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'modified_dt';
}
