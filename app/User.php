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
        'firstname','lastname', 'email', 'password', 'register', 'phone', 'address', 'dob', 'gender', 'created_by', 'groups', 'created_at', 'created_by_name', 'avatar_path'
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     protected $guard_name = 'web';

    protected static function boot()
    {
        parent::boot();
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class)->withTimestamps();
    }

    public function test_answer()
    {
        return $this->belongsToMany(Answer::class);
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
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
