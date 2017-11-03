<?php

namespace App\Http\Controllers;

use App\Notificacao;
use Illuminate\Http\Request;
use DB;
use Input;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $count = Notificacao::all();
       return view('home')->with('count', $count);
    }

    public function notificacao(Request $request){

        $getTable = new Notificacao();
        $getTable->nota = $request->input('nota');
        $getTable->data = date('d-m-Y');
        date_default_timezone_set('America/Sao_Paulo');
        $getTable->hora = date('H:i');
        $getTable->usuario = $request->input('usuario');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Mensagem realizada com sucesso!');
        return back();
    }

}
