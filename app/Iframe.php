<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iframe extends Model
{
    Protected $fillable = ['iframeid','iframe','keyframe', 'updated_at', 'created_at'];
}
