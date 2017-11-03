<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;
use App\Conselhosuperior as Conselho;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConselhosuperiorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $conselho = Conselho::all();

        $presidente = Conselho::where('titulo', '=', 'presidente')->with('pessoa')->get();
        $repres_ministerio = Conselho::where('titulo', '=', 'repres_ministerio')->with('pessoa')->get();
        $diretor = Conselho::where('titulo', '=', 'diretor')->with('pessoa')->get();
        $corpo_docente = Conselho::where('titulo', '=', 'corpo_docente')->with('pessoa')->get();
        $corpo_discente = Conselho::where('titulo', '=', 'corpo_discente')->with('pessoa')->get();
        $tec_administrativo = Conselho::where('titulo', '=', 'tec_administrativo')->with('pessoa')->get();
        $egresso = Conselho::where('titulo', '=', 'egresso')->with('pessoa')->get();
        $trabalhador = Conselho::where('titulo', '=', 'trabalhador')->with('pessoa')->get();
        $publico_estatal = Conselho::where('titulo', '=', 'publico_estatal')->with('pessoa')->get();
        $patronal = Conselho::where('titulo', '=', 'patronal')->with('pessoa')->get();
        $membros_natos = Conselho::where('titulo', '=', 'mebros_natos')->with('pessoa')->get();

        $pessoas_nome = Pessoa::pluck('nome','id');


        return view('conselhosuperior')->with('presidente', $presidente)
            ->with('repres_ministerio', $repres_ministerio)
            ->with('diretor', $diretor)
            ->with('corpo_docente', $corpo_docente)
            ->with('corpo_discente', $corpo_discente)
            ->with('tec_administrativo', $tec_administrativo)
            ->with('egresso', $egresso)
            ->with('trabalhador', $trabalhador)
            ->with('publico_estatal', $publico_estatal)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('patronal', $patronal)
            ->with('membros_natos', $membros_natos);

    }

    public function store(Request $request)
    {
        $getTable = new Conselho();
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->titulo = $request->input('titulo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('conselhosuperior');
    }

    public function destroy($id)
    {
        $remover = Conselho::findOrFail($id);
        $remover->delete();

        \Session::flash('mensagem_sucesso', 'Cadastro removido com sucesso!');
        return Redirect::to('conselhosuperior');
    }

    public function edit($id)
    {
        $edit = Conselho::findOrFail($id);

        $presidente = Conselho::where('titulo', '=', 'presidente')->with('pessoa')->get();
        $repres_ministerio = Conselho::where('titulo', '=', 'repres_ministerio')->with('pessoa')->get();
        $diretor = Conselho::where('titulo', '=', 'diretor')->with('pessoa')->get();
        $corpo_docente = Conselho::where('titulo', '=', 'corpo_docente')->with('pessoa')->get();
        $corpo_discente = Conselho::where('titulo', '=', 'corpo_discente')->with('pessoa')->get();
        $tec_administrativo = Conselho::where('titulo', '=', 'tec_administrativo')->with('pessoa')->get();
        $egresso = Conselho::where('titulo', '=', 'egresso')->with('pessoa')->get();
        $trabalhador = Conselho::where('titulo', '=', 'trabalhador')->with('pessoa')->get();
        $publico_estatal = Conselho::where('titulo', '=', 'publico_estatal')->with('pessoa')->get();
        $patronal = Conselho::where('titulo', '=', 'patronal')->with('pessoa')->get();
        $membros_natos = Conselho::where('titulo', '=', 'mebros_natos')->with('pessoa')->get();

        $pessoas_nome = Pessoa::pluck('nome','id');


        return view('conselhosuperior')->with('presidente', $presidente)
            ->with('repres_ministerio', $repres_ministerio)
            ->with('diretor', $diretor)
            ->with('corpo_docente', $corpo_docente)
            ->with('corpo_discente', $corpo_discente)
            ->with('tec_administrativo', $tec_administrativo)
            ->with('egresso', $egresso)
            ->with('trabalhador', $trabalhador)
            ->with('publico_estatal', $publico_estatal)
            ->with('pessoas_nome', $pessoas_nome)
            ->with('patronal', $patronal)
            ->with('edit', $edit)
            ->with('membros_natos', $membros_natos);

    }

    function update($id, Request $request)
    {

        $getTable = Conselho::find($id);
        $getTable->pessoas_id = $request->input('pessoas_id');
        $getTable->titulo = $request->input('titulo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro atualizado com sucesso!');
        return Redirect::to('conselhosuperior')
            ->with('success', 'You have been successfully update data');

    }

    public function rel_conselhosuperior($docx)
    {

        $docx->setTemplateSymbol('@');

        $presidente = Conselho::where('titulo', '=', 'presidente')->with('pessoa')->get();
        $repres_ministerio = Conselho::where('titulo', '=', 'repres_ministerio')->with('pessoa')->get();
        $diretor = Conselho::where('titulo', '=', 'diretor')->with('pessoa')->get();
        $corpo_docente = Conselho::where('titulo', '=', 'corpo_docente')->with('pessoa')->get();
        $corpo_discente = Conselho::where('titulo', '=', 'corpo_discente')->with('pessoa')->get();
        $tec_administrativo = Conselho::where('titulo', '=', 'tec_administrativo')->with('pessoa')->get();
        $egresso = Conselho::where('titulo', '=', 'egresso')->with('pessoa')->get();
        $trabalhador = Conselho::where('titulo', '=', 'trabalhador')->with('pessoa')->get();
        $publico_estatal = Conselho::where('titulo', '=', 'publico_estatal')->with('pessoa')->get();
        $patronal = Conselho::where('titulo', '=', 'patronal')->with('pessoa')->get();
        $membros_natos = Conselho::where('titulo', '=', 'mebros_natos')->with('pessoa')->get();


        foreach ($presidente as $rows):
            $presiden = $rows->pessoa->nome;
        endforeach;

        foreach ($repres_ministerio as $rows):
            $arr2[] = $rows->pessoa->nome;
        endforeach;
        $repres_ministeri = implode(', ', $arr2);
        $repres_ministeri = substr_replace($repres_ministeri, ' e', strrpos($repres_ministeri, ','), 1);

        foreach ($diretor as $rows):
            $arr3[] = $rows->pessoa->nome;
        endforeach;
        $direto = implode(', ', $arr3);
        $direto = substr_replace($direto, ' e', strrpos($direto, ','), 1);

        foreach ($corpo_docente as $rows):
            $arr4[] = $rows->pessoa->nome;
        endforeach;
        $corpo_docent = implode(', ', $arr4);
        $corpo_docent = substr_replace($corpo_docent, ' e', strrpos($corpo_docent, ','), 1);

        foreach ($corpo_discente as $rows):
            $arr5[] = $rows->pessoa->nome;
        endforeach;
        $corpo_discent = implode(', ', $arr5);
        $corpo_discent = substr_replace($corpo_discent, ' e', strrpos($corpo_discent, ','), 1);

        foreach ($tec_administrativo as $rows):
            $arr6[] = $rows->pessoa->nome;
        endforeach;
        $tec_administrativ = implode(', ', $arr6);
        $tec_administrativ = substr_replace($tec_administrativ, ' e', strrpos($tec_administrativ, ','), 1);

        foreach ($egresso as $rows):
            $arr7[] = $rows->pessoa->nome;
        endforeach;
        $egress = implode(', ', $arr7);
        $egress = substr_replace($egress, ' e', strrpos($egress, ','), 1);

        foreach ($trabalhador as $rows) :
            $arr8[] = $rows->pessoa->nome;
        endforeach;
        $trabalhado = implode(', ', $arr8);
        $trabalhado = substr_replace($trabalhado, ' e', strrpos($trabalhado, ','), 1);

        foreach ($publico_estatal as $rows):
            $arr9[] = $rows->pessoa->nome;
        endforeach;
        $publico_estata = implode(', ', $arr9);
        $publico_estata = substr_replace($publico_estata, ' e', strrpos($publico_estata, ','), 1);

        foreach ($patronal as $rows):
            $arr10[] = $rows->pessoa->nome;
        endforeach;
        $patrona = implode(', ', $arr10);
        $patrona = substr_replace($patrona, ' e', strrpos($patrona, ','), 1);


        foreach ($membros_natos as $rows):
            $arr10[] = $rows->pessoa->nome;
        endforeach;
        $membros_nato = implode(', ', $arr10);
        $membros_nato = substr_replace($membros_nato, ' e', strrpos($membros_nato, ','), 1);

        $variables1 = array(
            'CONSELHOPRES' => $presiden,
            'REPRES_MINISTERIO' => $repres_ministeri,
            'DIRETOR' => $direto,
            'CORPO_DOCENTE' => $corpo_docent,
            'TEC_ADMINISTRATIVO' => $tec_administrativ,
            'CORPO_DISCENTE' => $corpo_discent,
            'EGRESSO' => $egress,
            'PATRONAL' => $patrona,
            'TRABALHADOR' => $trabalhado,
            'PUBLICO_ESTATAL' => $publico_estata,
            'MEMBROS_NATOS' => $membros_nato,
        );

        $docx->replaceVariableByText($variables1);

   }

}
