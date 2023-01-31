<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use Auditable;

    public $table = 'users';

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'id', 'first_name', 'last_name',
        'fake_name', 'birth_date', 'year', 'gender', 'height',
        'width', 'nationality', 'photo', 'swear_god',
        'code', 'role_id', 'country_id', 'aria_id', 'city_id',
        'email', 'email_verified_at', 'password', 'verified',
        'verified_at', 'verification_token', 'two_factor', 'two_factor_code',
        'remember_token', 'created_at', 'updated_at', 'deleted_at',
        'two_factor_expires_at', 'phone','mediator_id','check_active', 'show_profile'
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $token = Str::random(64);
                $user->verification_token = $token;
                $user->save();
            } elseif (!$user->verification_token) {
                $token = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

            }
        });
    }

    public function getType()
    {
        switch ($this->role_id) {
            case '1';
                return 'admin';    //admin
                break;
            case '2':
                return 'mediator'; //mediator
                break;
            case '3':
                return 'user';    //user
                break;
            case '4':
                return 'FollowMediator';    //FollowMediator
                break;
        }
    }

    public function getTypeAr()
    {
        switch ($this->role_id) {
            case '1';
                return 'آدمن';    //admin
                break;
            case '2':
                return 'وسيط'; //mediator
                break;
            case '3':
                return 'مستخدم';    //user
                break;
            case '4':
                return 'تابع وسيط';    //FollowMediator
                break;
        }
    }


    public function getFullName()
    {
        return "$this->first_name  $this->last_name";
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('/' . $val) : "";
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function user_question_answers()
    {
        return $this->hasMany(UserQuestionAnswer::class, 'user_id', 'id');
    }

    public function age()
    {
        return \Carbon\Carbon::parse($this->birth_date)->diff(\Carbon\Carbon::now())->format('%y عام   ');
    }


    public function getGender()
    {
        return $this->gender == 'male' ? trans('global.male') : trans('global.female');

    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function aria()
    {
        return $this->belongsTo(Aria::class, 'aria_id', 'id');
    }


//    public function getPhotoAttribute($value)
//    {
//        if (!$value) {
//            return asset('assets/man.png');
//        }
//        return asset('storage/users/' . $value);
//    }


}
