<?php

namespace App\Http\Controllers;

use App\Corpo_administrativo;
use Illuminate\Http\Request;

class Corpo_administrativoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rel_administrativo($id,$docx){

        $docx->setTemplateSymbol('@');

        $corpo_administrativo = Corpo_administrativo::select('pessoas_id')
            ->with('pessoa')->get();

        foreach ($corpo_administrativo as $rows) {

            $servidor['SERVIDOR'] = $rows->pessoa->nome;
            $cargo['CARGO'] = $rows->pessoa->titulo;
            $regime['REGIME'] = $rows->regimtrab;
            $resultado[] = array_merge($servidor, $cargo,$regime);
        }

        $docx->replaceTableVariable($resultado, array('parseLineBreaks' => true));
    }
}
