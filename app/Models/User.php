<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\HasFactoryuse;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'userable_type',
        'userable_id',
        'device_token'
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
    

    ##################################### RELATIONS ######################################

    public function userable()
    {
        return $this->morphTo();
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function distresses()
    {
        return $this->belongsToMany(Distress::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function appliedtasks()
    {
        return $this->belongsToMany(Task::class,'applied_task')->withPivot(['task_id', 'user_id', 'cost']);
    }

    public function assignedtasks()
    {
        return $this->belongsToMany(Task::class,'assigned_task')->withPivot(['task_id', 'user_id', 'assigner_id', 'cost']);
    }

    public function recommendedtasks()
    {
        return $this->belongsToMany(Task::class,'recommended_task');
    }

    protected $appends = ['pusher_channel'];

    public function getPusherChannelAttribute()
    {
        return $this->email . '-' . $this->id;
    }

    public function invitedtasks()
    {
        return $this->belongsToMany(Task::class,'invited_task');
    }


    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_user','user_id', 'transaction_id')->withPivot(['transaction_id', 'user_id', 'to_user_id', 'mission_type', 'name', 'amount', 'description', 'mission_id', 'tax_password', 'tax_file']);
    }

    public function notifications(): BelongsTo
    {
        return $this->hasMany(Notification::class);
    }
    public static function court()
    {
        return [
            'Alexandria' => 'Alexandria',
        ];
    }

    public static function governorates()
    {
        return [
            'Alexandria' => 'Alexandria',
            'Assiut' => 'Assiut',
            'Aswan' => 'Aswan',
            'Beheira' => 'Beheira',
            'Bani Suef' => 'Bani Suef',
            'Cairo' => 'Cairo',
            'Daqahliya' => 'Daqahliya',
            'Damietta' => 'Damietta',
            'Fayyoum' => 'Fayyoum',
            'Gharbiya' => 'Gharbiya',
            'Giza' => 'Giza',
            'Helwan' => 'Helwan',
            'Ismailia' => 'Ismailia',
            'Kafr El Sheikh' => 'Kafr El Sheikh',
            'Luxor' => 'Luxor',
            'Marsa Matrouh' => 'Marsa Matrouh',
            'Minya' => 'Minya',
            'Monofiya' => 'Monofiya',
            'New Valley' => 'New Valley',
            'North Sinai' => 'North Sinai',
            'Port Said' => 'Port Said',
            'Qalioubiya' => 'Qalioubiya',
            'Qena' => 'Qena',
            'Red Sea' => 'Red Sea',
            'Sharqiya' => 'Sharqiya',
            'Sohag' => 'Sohag',
            'South Sinai' => 'South Sinai',
            'Suez' => 'Assiut',
            'Tanta' => 'Assiut',
        ];
    }


}
