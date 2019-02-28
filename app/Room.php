<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = 'modified_dt';

    protected $primaryKey = 'room_id';
    protected $table = "mrm_rooms";
    protected $dates = ['modified_dt'];

    protected $fillable = [
        "room_name",
        "room_type",
        "num_member",
        "equipment",
        "description",
        "isdeleted",
        "modified_by",
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'room_id', 'room_id');
    }

}
