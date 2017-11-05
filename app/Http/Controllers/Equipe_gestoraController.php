<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use App\Equipe_gestora as Equipegestora;
use Illuminate\Support\Facades\Redirect;
class Equipe_gestoraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $desenvolvimento_educacional = Equipegestora::where('categoria', '=', 'desenvolvimento_educacional')->with('pessoa')->get();
        $administracao_planejamento = Equipegestora::where('categoria', '=', 'administracao_planejamento')->with('pessoa')->get();
        $ensino = Equipegestora::where('categoria', '=', 'ensino')->with('pessoa')->get();
        $assistencia_educando = Equipegestora::where('categoria', '=', 'assistencia_educando')->with('pessoa')->get();
        $pesquisa = Equipegestora::where('categoria', '=', 'pesquisa')->with('pessoa')->get();
        $extensao = Equipegestora::where('categoria', '=', 'extensao')->with('pessoa')->get();
        $diretor = Equipegestora::where('categoria', '=', 'diretor')->with('pessoa')->get();
        $pessoas_nome = Pessoa::orderBy('nome', 'asc')->pluck('nome','id');

        return view('equipegestora')->with('desenvolvimento_educacional', $desenvolvimento_educacional)
            ->with('administracao_planejamento', $administracao_planejamento)
            ->with('ensino', $ensino)
            ->with('assistencia_educando', $assistencia_educando)
            ->with('pesquisa', $pesquisa)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('diretor', $diretor)
            ->with('extensao', $extensao);
    }

    public function store(Request $request)
    {

        $getTable = new Equipegestora();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->categoria = $request->input('categoria');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('equipe_gestora');
    }

    public function destroy($id)
    {
        $remover = Equipegestora::findOrFail($id);
        $remover->delete();
        \Session::flash('mensagem_destroy', 'Cadastro removido com sucesso!');
        return Redirect::to('equipe_gestora');
    }

    public function edit($id)
    {
        $edit = Equipegestora::findOrFail($id);

        $desenvolvimento_educacional = Equipegestora::where('categoria', '=', 'desenvolvimento_educacional')->with('pessoa')->get();
        $administracao_planejamento = Equipegestora::where('categoria', '=', 'administracao_planejamento')->with('pessoa')->get();
        $ensino = Equipegestora::where('categoria', '=', 'ensino')->with('pessoa')->get();
        $assistencia_educando = Equipegestora::where('categoria', '=', 'assistencia_educando')->with('pessoa')->get();
        $pesquisa = Equipegestora::where('categoria', '=', 'pesquisa')->with('pessoa')->get();
        $extensao = Equipegestora::where('categoria', '=', 'extensao')->with('pessoa')->get();
        $diretor = Equipegestora::where('categoria', '=', 'diretor')->with('pessoa')->get();
        $pessoas_nome = Pessoa::pluck('nome','id');


        return view('equipegestora')->with('desenvolvimento_educacional', $desenvolvimento_educacional)
            ->with('administracao_planejamento', $administracao_planejamento)
            ->with('ensino', $ensino)
            ->with('assistencia_educando', $assistencia_educando)
            ->with('pesquisa', $pesquisa)
            ->with('extensao', $extensao)
            ->with('diretor', $diretor)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('edit', $edit);

    }

    function update($id, Request $request)
    {

        $getTable = Equipegestora::find($id);
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->categoria = $request->input('categoria');
        $getTable->save();

        \Session::flash('mensagem_update', 'Cadastro atualizado com sucesso!');
        return Redirect::to('equipe_gestora');


    }

    public function rel_equipegestora($docx)
    {
        $docx->setTemplateSymbol('@');

        $query1 = Equipegestora::where('categoria', '=', 'desenvolvimento_educacional')->with('pessoa')->get();
        $query2 = Equipegestora::where('categoria', '=', 'administracao_planejamento')->with('pessoa')->get();
        $query3 = Equipegestora::where('categoria', '=', 'ensino')->with('pessoa')->get();
        $query4 = Equipegestora::where('categoria', '=', 'assistencia_educando')->with('pessoa')->get();
        $query5 = Equipegestora::where('categoria', '=', 'pesquisa')->with('pessoa')->get();
        $query6 = Equipegestora::where('categoria', '=', 'extensao')->with('pessoa')->get();
        $query7 = Equipegestora::where('categoria', '=', 'diretor')->with('pessoa')->get();

        foreach($query1 as $valor):
            $educacional = $valor->pessoa->nome;
        endforeach;
        foreach($query2 as $valor):
            $planejamento = $valor->pessoa->nome;
        endforeach;
        foreach($query3 as $valor):
            $ensino = $valor->pessoa->nome;
        endforeach;
        foreach($query4 as $valor):
            $educando = $valor->pessoa->nome;
        endforeach;
        foreach($query5 as $valor):
            $pesquisa = $valor->pessoa->nome;
        endforeach;
        foreach($query6 as $valor):
            $extensao = $valor->pessoa->nome;
        endforeach;
        foreach($query7 as $valor):
            $diretor = $valor->pessoa->nome;
        endforeach;

        $var5 = array('EDUCACIONAL' => $educacional,
                      'PLANEJAMENTO' => $planejamento,
                      'ENSINO' =>$ensino,
                      'EDUCANDO'=>$educando,
                      'PESQUISA'=>$pesquisa,
                      'EXTENSAO' =>$extensao,
                      'DIRETOR_GERAL' =>$diretor);


        $docx->replaceVariableByText($var5);


    }

}
