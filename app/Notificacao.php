<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacaos';

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\User','users_id');
    }

}
