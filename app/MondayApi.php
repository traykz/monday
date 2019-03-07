<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MondayApi extends Model
{

    protected $table='monday_apis';

  
    Protected $fillable = ['member','pulse_id','pulse_name','pulse_status', 'pulse_category', 'pulse_timetrack', 'pulse_created', 'pulse_updated'];


    public function times()
    {
        return $this->HasMany('App\Time');
    }




}


