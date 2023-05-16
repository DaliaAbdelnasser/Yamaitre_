<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $guard_name = 'admin';

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
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|confirmed',
        'roles' => 'required'
    ];

    /**
     * Set password encryption.
     *
     * @param String $val
     * @return void
     */
    public function setPasswordAttribute($val)
    {
        if ($val) {
            $this->attributes['password'] = bcrypt($val);
        }
    }
    
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
