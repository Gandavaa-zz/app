<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $guarded  = [];

    public function test(){
        return $this->belongsTo('App\Test');
    }

    public function next(){        
        return $this->where('id', '>', $this->id)->orderBy('id','asc')->first();
    
    }
    public  function previous(){        
        return $this->where('id', '<', $this->id)->orderBy('id','desc')->first();    
    }
}
