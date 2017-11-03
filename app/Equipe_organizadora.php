<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe_organizadora extends Model
{
    protected $collection = 'equipeorganizadoras';
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }
}
