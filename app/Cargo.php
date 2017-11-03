<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    protected $collection = 'cargos';
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa');
    }

}
