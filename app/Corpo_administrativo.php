<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corpo_administrativo extends Model
{
    protected $table = 'corpo_administrativos';

    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }
}
