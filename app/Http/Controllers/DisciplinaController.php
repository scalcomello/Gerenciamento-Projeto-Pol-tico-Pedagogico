<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Ementario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DisciplinaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $disciplinas = Disciplina::all();

        return view('disciplina')->with('disciplinas', $disciplinas);

    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50|unique:disciplinas',

        ]);
        if($validator->fails()){
            return Redirect('disciplina')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Disciplina();
        $getTable->nome = $request->input('nome');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Disciplina cadastrada com sucesso!');
        return Redirect::to('disciplina');
    }

    public function destroy($id)
    {
        $remover = Disciplina::findOrFail($id);

        $remover->delete();
        \Session::flash('mensagem_sucesso', 'Disciplina removida com sucesso!');
        return Redirect::to('disciplina');
    }

    public function edit($id)
    {
        $edit = Disciplina::findOrFail($id);

        $disciplinas = Disciplina::all();

        return view('disciplina')->with('disciplinas', $disciplinas)
            ->with('edit', $edit);
    }

    public function update($id, Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50'

        ]);
        if ($validator->fails()) {
            return Redirect('disciplina/' . $id . '/editar')
                ->withErrors($validator)
                ->withInput();
        }
        $getTable = Disciplina::find($id);
        $getTable->nome = $request->input('nome');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Disciplina atualizada com sucesso!');
        return Redirect::to('disciplina');

    }

}
