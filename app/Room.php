<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'room_id';
    protected $table = "mrm_rooms";
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'modified_dt';
}
