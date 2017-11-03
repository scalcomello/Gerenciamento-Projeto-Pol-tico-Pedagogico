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
}
