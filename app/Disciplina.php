<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplinas';

    public $timestamps = false;

    public function ementario()
    {
        return $this->belongsTo('App\Ementario');
    }


    public function bibliografia()
    {
        return $this->belongsTo('App\Bibliografia');
    }

}
