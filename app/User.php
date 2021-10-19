<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, RecordsActivity;

    // protected $primaryKey = 'user_id';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname', 'email', 'password', 'register', 'phone', 'address', 'dob', 'gender', 'created_by', 'groups', 'created_at', 'created_by_name', 'avatar_path', 'candidate_id'
    ];

    // protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dateFormat = 'Y-m-d';

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['fullname', 'created_date', 'created_by_name'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard_name = 'web';

    protected static function boot()
    {
        parent::boot();
    }

    public function avatar()
    {
        if (! $this->avatar_path)
        {
            if($this->gender =='male')
                return '/storage/avatar/man.png';
            else return '/storage/avatar/woman.png';
        }

        return '/storage/'.$this->avatar_path;
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'user_test')->withTimestamps();
    }

    public function test_answer()
    {
        return $this->belongsToMany(Answer::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function getCreatedByNameAttribute()
    {
        return User::where('id', $this->created_by)->pluck('firstname')->first();
    }

    public function getFullNameAttribute(){
        return $this->firstname . ', '. $this->lastname;
    }

    public function getCreatedDateAttribute(){

        return Carbon::parse($this->created_at)->format('Y-m-d');

    }

    // public function getIdAttribute(){

    //     return $this->id;

    // }
}
