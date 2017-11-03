<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliografia extends Model
{
    protected $collection = 'bibliografias';
    public $timestamps = false;

    public function disciplina()
    {
        return $this->belongsTo('App\Disciplina','disciplinas_id');
    }

    public function livro()
    {
        return $this->belongsTo('App\Livro','livros_id');
    }

    public function ementario()
    {
        return $this->belongsTo('App\Ementario','disciplinas_id');
    }


}
