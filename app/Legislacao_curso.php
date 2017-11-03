<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legislacao_curso extends Model
{
    protected $table = 'legislacao_cursos';

    public $timestamps = false;

    public function curso()
    {
        return $this->HasMany('App\Curso');
    }
    public function legislacao()
    {
        return $this->belongsTo('App\Legislacao','legislacaos_id');
    }
}
