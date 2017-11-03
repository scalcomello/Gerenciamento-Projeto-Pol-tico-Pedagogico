<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpo_docente extends Model
{
    protected $table = 'corpodocentes';

    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }
}
