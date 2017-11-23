<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pessoa extends Model
{

    public $timestamps = true;
    protected $table = 'pessoas';

    public function conselho()
    {
        return $this->belongsTo('App\Conselhosuperior');
    }
}
