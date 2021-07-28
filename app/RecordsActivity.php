<?php 

namespace App;

trait RecordsActivity{

    protected static function bootRecordsActivity(){

        if (auth()->guest()) return;
        
        foreach (static::getActivitiesToRecord() as $event){

            if($event=='created')
            static::created(function ($model) use ($event) {
                $model->recordActivity($event);
            });
            
            elseif($event == 'updated')
            static::updated(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    } 

    protected static function getActivitiesToRecord()
    {
        return ['created', 'updated'];
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)           
        ]);

    }

    public function activity(){
        return $this->morphMany('App\Activity', 'subject');
    }

    public function getActivityType($event)
    {
        $type = strtolower( (new \ReflectionClass($this))->getShortName());
        
        return "{$event}_{$type}";
    }

}