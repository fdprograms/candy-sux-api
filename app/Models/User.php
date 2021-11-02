<?php

namespace App\Models;

use \Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    //SoftDeletes
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'firstname',
        'lastname',
        'password',
        'company_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     *
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('email', $username)->first();
    }

    /**
     * roles.
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    /**
     * generateToken.
     *
     * @return void
     */
    public function generateToken() : string
    {
        return $this->createToken(Str::random(5) . '-oauth-test')->accessToken;
    }
}
