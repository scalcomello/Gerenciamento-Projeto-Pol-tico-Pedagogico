<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conselhosuperior extends Model
{
    protected $table = 'conselhosuperiors';

    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }

    public function grupo_conselhosuperior()
    {
        return $this->belongsTo('App\Grupo_conselhosuperior','grupo_conselhosuperior_id');
    }
}
