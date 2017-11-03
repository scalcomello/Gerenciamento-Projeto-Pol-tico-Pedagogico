<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    public $timestamps = false;


    public function subdocumento()
    {
        return $this->hasMany('App\Subdocumento','documentos_id');
    }

}
