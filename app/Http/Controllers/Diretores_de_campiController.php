<?php

namespace App\Http\Controllers;

use App\Diretores_de_campi as Diretores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Pessoa;

class Diretores_de_campiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $diretores = Diretores::with('pessoa')->get();
        //$diretores = Diretores::all();
        $pessoas_nome = Pessoa::orderBy('nome', 'asc')->pluck('nome','id');

        return view('diretoresdecampi')
            ->with('pessoas_nome', $pessoas_nome)
            ->with('diretores', $diretores);

    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [


            'campi' => 'required|string|min:3|max:50',

        ]);
        if ($validator->fails()) {
            return Redirect('diretores_de_campi')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Diretores();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->campi = $request->input('campi');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('diretores_de_campi');
    }

    public function destroy($id)
    {
        $remover = Diretores::findOrFail($id);

        $remover->delete();

        \Session::flash('mensagem_destroy', 'Cadastro removido com sucesso!');
        return Redirect::to('diretores_de_campi');
    }

    public function edit($id)
    {
        $edit = Diretores::findOrFail($id);

        $diretores = Diretores::with('pessoa')->get();
        $pessoas_nome = Pessoa::orderBy('nome', 'asc')->pluck('nome','id');

        return view('diretoresdecampi')
            ->with('pessoas_nome', $pessoas_nome)
            ->with('diretores', $diretores)
        ->with('edit', $edit);

        $diretores = Diretores::all();



    }

    function update($id, Request $request)
    {
        $validator = validator($request->all(), [

            'campi' => 'required|string|min:3|max:50'

        ]);
        if ($validator->fails()) {
            return Redirect('diretoresdecampi/' . $id . '/editar')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = Diretores::find($id);
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->campi = $request->input('campi');
        $getTable->save();

        \Session::flash('mensagem_update', 'Cadastro atualizado com sucesso!');
        return Redirect::to('diretores_de_campi');


    }

    function rel_diretorescampi($docx)
    {
        //$docx = new \Phpdocx\Create\CreateDocxFromTemplate('template/diretorescampi.docx');

        $docx->setTemplateSymbol('@');

        $diretores = Diretores::all();

        foreach ($diretores as $valor):
            $campi[] = $valor["campi"];
            $campi[] = $valor["diretor"];
            $campi[] = '\r';
        endforeach;

        $strx = implode('\n',$campi);


        $var = array('CAMPI' => $strx);
        $option = array('parseLineBreaks' => true);
        $docx->replaceVariableByText($var, $option);


        //$docx->createDocx('curso/diretorescampi');
    }

}
