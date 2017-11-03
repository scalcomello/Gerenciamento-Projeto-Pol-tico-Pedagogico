<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ementario extends Model
{
    protected $collection = 'ementarios';
    public $timestamps = false;

    public function disciplina()
    {
        return $this->belongsTo('App\Disciplina','disciplinas_id');
    }


}
