<?php

namespace App\Http\Controllers;

use App\Bibliografia;
use App\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BibliografiaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       // $bibliografia = Bibliografia::all();
          $bibliografiabasico = Bibliografia::where('tipo', '=', 'basica')->with('livro')->get();
        $bibliografiacomplementar = Bibliografia::where('tipo', '=', 'complementar')->with('livro')->get();
        $bibliografia = Bibliografia::with('livro')->get();

           return view('bibliografia')
           ->with('bibliografia', $bibliografia);


    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'autor' => 'required|string|min:3|max:150|',
            'sobrenome' => 'required|string|min:3|max:150|',
            'titulo' => 'required|string|min:3|max:550|',
            'local' => 'required|string|min:2|max:50|',
            'editora' => 'required|string|min:2|max:50|',
            'ano' => 'required|string|min:4|max:8|',
            'pagina' => 'required|string|min:1|max:6|',
        ]);
        if ($validator->fails()) {
            return Redirect('bibliografia')
                ->withErrors($validator)
                ->withInput();
        }
        $getTable = new Livro();
        $getTable->autor = $request->input('autor');
        $getTable->sobrenome = $request->input('sobrenome');
        $getTable->titulo = $request->input('titulo');
        $getTable->subtitulo = $request->input('subtitulo');
        $getTable->edicao = $request->input('edicao');
        $getTable->local = $request->input('local');
        $getTable->editora = $request->input('editora');
        $getTable->ano = $request->input('ano');
        $getTable->pagina = $request->input('pagina');
        $getTable->volume = $request->input('volume');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function destroy($id)
    {
        $remover = Bibliografia::findOrFail($id);
        $remover->delete();

        \Session::flash('mensagem_sucesso', 'Removido com sucesso!');
        return back();
    }

}
