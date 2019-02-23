<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'room_id';
    protected $table = "mrm_rooms";
    const CREATED_AT = null;
    const UPDATED_AT = 'modified_dt';

    protected $fillable = [
        "room_name",
        "room_type",
        "num_member",
        "equipment",
        "description",
        "isdeleted",
        "modified_by",
    ];
}
