<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getOnlineAttribute() {
        return (Carbon::now()->diffInMinutes(new Carbon($this->last_seen))) <= 5;
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
