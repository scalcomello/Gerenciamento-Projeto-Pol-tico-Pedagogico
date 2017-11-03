<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe_gestora extends Model
{
    protected $collection = 'equipe_gestoras';
    public $timestamps = false;

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa','pessoas_id');
    }
}
