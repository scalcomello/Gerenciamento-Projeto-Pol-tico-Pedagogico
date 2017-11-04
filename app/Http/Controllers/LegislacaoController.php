<?php

namespace App\Http\Controllers;

use App\Legislacao;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Redirect;

class LegislacaoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $legislacao = Legislacao::all();

        return view('legislacao')->with('legislacao', $legislacao);

    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'lei' => 'required|string|min:3|max:250|unique:legislacaos',
            'ementa' => 'required|string|min:3|max:5550'

        ]);
        if($validator->fails()){
            return Redirect('legislacao')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Legislacao();
        $getTable->lei = $request->input('lei');
        $getTable->ementa = $request->input('ementa');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('legislacao');
    }

    public function destroy($id)
    {
        $remover = Legislacao::findOrFail($id);

        $remover->delete();
        \Session::flash('mensagem_sucesso', 'Cadastro removido com sucesso!');
        return Redirect::to('legislacao');
    }

    public function edit($id)
    {
        $edit = Legislacao::findOrFail($id);

        $legislacao = Legislacao::all();

        return view('legislacao')->with('legislacao', $legislacao)
            ->with('edit', $edit);

    }

    public function update($id, Request $request)
    {
        $validator = validator($request->all(), [

            'lei' => 'required|string|min:3|max:50',
            'ementa' => 'required|string|min:3|max:5550'

        ]);
        if($validator->fails()){
            return Redirect('legislacao/'.$id.'/editar')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = Legislacao::find($id);
        $getTable->lei = $request->input('lei');
        $getTable->ementa = $request->input('ementa');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro atualizado com sucesso!');
        return Redirect::to('legislacao')
            ->with('success','You have been successfully update data');

    }

}
