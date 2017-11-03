<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pessoa extends Model
{
    protected $table = 'pessoas';

    public $timestamps = true;

    public function conselho()
    {
        return $this->belongsTo('App\Conselhosuperior');
    }
}
