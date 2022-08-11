<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    protected $fillable = [
        'user_id',
        'logout_at',
        'login_at',
        'login_ip',
        'login_os',
        'login_token',
        'login_device',
        'login_browser'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
