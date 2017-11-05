<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componentecurricular extends Model
{
    protected $table = 'componentecurriculars';

    public $timestamps = false;

    public function ementario()
    {
        return $this->belongsTo('App\Ementario');
    }
}
