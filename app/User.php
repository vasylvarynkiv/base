<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Collective\Html\Eloquent\FormAccessible;
use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use FormAccessible;

    const USER_STATUS = [
        0 => 'Inactive',
        1 => 'Active',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'password',
        'date_of_birth',
        'last_login_at',
        'notes'
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
        'last_login_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStatusNameAttribute()
    {
        return static::USER_STATUS[$this->status];
    }

    /**
     * Get the user's date of birth.
     *
     * @param string $value
     * @return string
     */
    public function getDateOfBirthAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('m/d/Y');
        }

        return null;
    }

    public function getLastLoginAtAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('H:i:s d.m.Y');
        }

        return null;
    }

    /**
     * Get the user's date of birth for forms.
     *
     * @param string $value
     * @return string
     */
    public function formDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function lastAdmin()
    {
        $isAdmin = $lastAdmin = false;

        foreach ($this->roles as $role) {
            if ($role->name == 'Admin') {
                $isAdmin = true;
            }
        }

        if ($isAdmin) {
            $lastAdmin = DB::table('model_has_roles')->where('role_id', 1)->count();

            $lastAdmin = ($lastAdmin == 1);
        }

        return $lastAdmin;
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
