<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public $timestamps = false;

    public function group() {
        return $this->belongsTo('App\Group');
    }

}
