<?php

namespace App\Http\Controllers;

use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = Notificacao::with('usuario')->get();

        return view('home')->with('count', $count);
    }



    function notificacao(Request $request){

        $getTable = new Notificacao();
        $getTable->nota = $request->input('nota');
        $getTable->data = date('d-m-Y');
        date_default_timezone_set('America/Sao_Paulo');
        $getTable->hora = date('H:i');
        $getTable->users_id = $request->input('usuario');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Mensagem realizada com sucesso!');
        return back();
    }

    public function edit($id)
    {
        $edit = Notificacao::findOrFail($id);
        $count = Notificacao::all();

        return view('home')
            ->with('count', $count)
            ->with('edit', $edit);
    }

    function update($id, Request $request)
    {

        $getTable = Notificacao::find($id);
        $getTable->nota = $request->input('nota');
        $getTable->data = date('d-m-Y');
        date_default_timezone_set('America/Sao_Paulo');
        $getTable->hora = date('H:i');
        $getTable->users_id = $request->input('usuario');
        $getTable->save();

        return back()->with('mensagem_update', 'Comentario atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $remover = Notificacao::findOrFail($id);
        $remover->delete();

        return back()->with('mensagem_destroy', 'Comentario removido com sucesso.');
    }
}
