<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Candidate extends Model
{
    // protected $connection = 'mysql2';
    protected $table = 'aauth_users';

    protected $appends = ['fullname'];

    protected $guarded = [];

    public function getFullNameAttribute(){
        return $this->firstname . ', '. $this->lastname;
    }

    public function company(){

        return $this->belongsTo(Company::class,'company_id', 'id');

    }

    public function tests()
    {
        // return DB::connection('mysql2')->table('user_test')->where('user_id', $this->id)->get();
        return $this->hasMany('App\Test_User','user_id');
    }
}
