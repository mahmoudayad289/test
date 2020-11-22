<?php

namespace App;

use App\Traits\SearchAllModelsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use Notifiable, HasRoles, SearchAllModelsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
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


    protected $appends = ['image_path'];


    // attributes


    public function getImagePathAttribute()
    {
        return asset('uploads/image_user/' . $this->avatar);
    }


    // scopes

    public function scopeWhereNotRole($query, array $role_name)
    {
        return $query->when($role_name, function ($qu) use ($role_name) {
            return $qu->whereHas('roles', function ($q) use ($role_name) {
                return $q->whereNotIn('name', $role_name);
            });
        });

    }


    public function scopeWhenRole($query, array $role_name)
    {
        return $query->when($role_name, function ($qu) use ($role_name) {
            return $qu->whereHas('roles', function ($q) use ($role_name) {
                return $q->where('name', $role_name);
            });
        });
    }

    public function scopeSearchByRoles($query, $roles)
    {
        return $query->when($roles, function ($qu) use ($roles) {
            return $qu->whereHas('roles', function ($q) use ($roles) {
                return $q->where('name', 'LIKE', '%' . $roles . '%')
                    ->orWhere('id', 'LIKE', '%' . $roles . '%');
            });
        });
    }

}
