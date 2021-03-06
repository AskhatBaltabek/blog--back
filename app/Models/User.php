<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Permissions\HasPermissionsTrait as HasPermission;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes, HasPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function validate($data) {
        $response = new Collection;
        return $response;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'users_roles');
    }
}
