<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdocumento extends Model
{
    protected $table = 'subdocumentos';
    public $timestamps = false;

    public function documento()
    {
        return $this->belongsTo('App\Documento','documentos_id');
    }

}
