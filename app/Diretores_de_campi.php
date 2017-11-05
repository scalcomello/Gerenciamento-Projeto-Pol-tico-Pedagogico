<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diretores_de_campi extends Model
{
    protected $table = 'campis';

    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }
}
