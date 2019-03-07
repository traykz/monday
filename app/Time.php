<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{

    protected $table='times';


  
    Protected $fillable = ['monday_api_id','horas_dia', 'pulse_created', 'pulse_updated'];


    public function MondayApi()
    {
        return $this->BelongsTo('App\MondayApi');
    }


}
