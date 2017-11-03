<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';

    public $timestamps = false;


    public function bibliografia()
    {
        return $this->belongsTo('App\Bibliografia');
    }
}
