<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Test extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'test';
    protected $primaryKey = 'test_id';

    public function participants()
    {
        // return DB::connection('mysql2')->table('user_test')->where('user_id', $this->id)->get();
        return $this->belongsToMany(Participant::class, env('DB_DATABASE_SECOND').'.user_test', 'test_id', 'user_id');

    }

}
