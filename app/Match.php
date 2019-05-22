<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    public $timestamps=false;

    public function group() {
        return $this->belongsTo('App\Group');
    }
}
