<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Participant extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'aauth_users';

    protected $appends = ['fullname'];

    public function getFullNameAttribute(){
        return $this->firstname . ', '. $this->lastname;
    }

    public function company(){

        return $this->belongsTo(Company::class,'company_id', 'id');

    }

    public function tests()
    {
        return DB::connection('mysql2')->table('user_test')->where('user_id', $this->id)->get();
        // return $this->belongsToMany(Test::class, env('DB_DATABASE_SECOND').'.user_test', 'user_id', 'test_id', 'user_test_id');
    }
}
