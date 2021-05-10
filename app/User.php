<?php

namespace App;

use App\Models\Jadwal;
use App\Models\Pendonor;
use App\Models\Permintaan;
use App\Notifications\ApiVerificationEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'email_verified_at', 'password', 'role', 'nama_rs', 'phone', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isPmi()
    {
        if($this->role == 'pmi'){
            return true;
        }

        return false;
    }

    public function isRs()
    {
        if($this->role == 'rs'){
            return true;
        }
        return false;
    }

    public function permintaans()
    {
        return $this->hasMany(Permintaan::class, 'user_id', 'id');
    }

    public function pendonors()
    {
        return $this->hasMany(Pendonor::class, 'user_id', 'id');
    }

    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new ApiVerificationEmail());
    }

    public function schedulles()
    {
        return $this->hasMany(Jadwal::class);
    }

}
