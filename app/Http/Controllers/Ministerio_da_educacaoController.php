<?php

namespace App\Http\Controllers;


use App\ Ministeriodaeducacao as Ministerio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class Ministerio_da_educacaoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $presidente = Ministerio::where('cargo', '=', 'presidente')->get();
        $ministro = Ministerio::where('cargo', '=', 'ministro')->get();
        $sec_educ_prof_tecn = Ministerio::where('cargo', '=', 'sec_educ_prof_tecn')->get();
        $reitor = Ministerio::where('cargo', '=', 'reitor')->get();
        $pro_reitor_admin_plan = Ministerio::where('cargo', '=', 'pro_reitor_admin_plan')->get();
        $pro_reitor_ensino = Ministerio::where('cargo', '=', 'pro_reitor_ensino')->get();
        $pro_reitor_desenv_inst = Ministerio::where('cargo', '=', 'pro_reitor_desenv_inst')->get();
        $pro_reitor_posgrad_pesq_ino = Ministerio::where('cargo', '=', 'pro_reitor_posgrad_pesq_ino')->get();
        $pro_reitor_ext = Ministerio::where('cargo', '=', 'pro_reitor_ext')->get();

        return view('ministerioeducacao')->with('presidente', $presidente)
            ->with('ministro', $ministro)
            ->with('sec_educ_prof_tecn', $sec_educ_prof_tecn)
            ->with('reitor', $reitor)
            ->with('pro_reitor_admin_plan', $pro_reitor_admin_plan)
            ->with('pro_reitor_ensino', $pro_reitor_ensino)
            ->with('pro_reitor_desenv_inst', $pro_reitor_desenv_inst)
            ->with('pro_reitor_posgrad_pesq_ino', $pro_reitor_posgrad_pesq_ino)
            ->with('pro_reitor_ext', $pro_reitor_ext);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50'

        ]);
        if ($validator->fails()) {
            return Redirect('ministerio_da_educacao')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Ministerio();
        $getTable->nome = $request->input('nome');
        $getTable->cargo = $request->input('cargo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('ministerio_da_educacao');
    }

    public function destroy($id)
    {
        $remover = Ministerio::findOrFail($id);
        $remover->delete();
        \Session::flash('mensagem_sucesso', 'Cadastro removido com sucesso!');
        return Redirect::to('ministerio_da_educacao');
    }

    public function edit($id)
    {
        $edit = Ministerio::findOrFail($id);

        $presidente = Ministerio::where('cargo', '=', 'presidente')->get();
        $ministro = Ministerio::where('cargo', '=', 'ministro')->get();
        $sec_educ_prof_tecn = Ministerio::where('cargo', '=', 'sec_educ_prof_tecn')->get();
        $reitor = Ministerio::where('cargo', '=', 'reitor')->get();
        $pro_reitor_admin_plan = Ministerio::where('cargo', '=', 'pro_reitor_admin_plan')->get();
        $pro_reitor_ensino = Ministerio::where('cargo', '=', 'pro_reitor_ensino')->get();
        $pro_reitor_desenv_inst = Ministerio::where('cargo', '=', 'pro_reitor_desenv_inst')->get();
        $pro_reitor_posgrad_pesq_ino = Ministerio::where('cargo', '=', 'pro_reitor_posgrad_pesq_ino')->get();
        $pro_reitor_ext = Ministerio::where('cargo', '=', 'pro_reitor_ext')->get();

        return view('ministerioeducacao')->with('presidente', $presidente)
            ->with('ministro', $ministro)
            ->with('sec_educ_prof_tecn', $sec_educ_prof_tecn)
            ->with('reitor', $reitor)
            ->with('pro_reitor_admin_plan', $pro_reitor_admin_plan)
            ->with('pro_reitor_ensino', $pro_reitor_ensino)
            ->with('pro_reitor_desenv_inst', $pro_reitor_desenv_inst)
            ->with('pro_reitor_posgrad_pesq_ino', $pro_reitor_posgrad_pesq_ino)
            ->with('pro_reitor_ext', $pro_reitor_ext)
            ->with('edit', $edit);
    }

    public function update($id, Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50'

        ]);
        if ($validator->fails()) {
            return Redirect('ministerio_da_educacao/' . $id . '/editar')
                ->withErrors($validator)
                ->withInput();
        }
        $getTable = Ministerio::find($id);
        $getTable->nome = $request->input('nome');
        $getTable->cargo = $request->input('cargo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro atualizado com sucesso!');
        return Redirect::to('ministerio_da_educacao');

    }

    public function rel_ministeriodaeducacao($docx){

        //$docx = new \Phpdocx\Create\CreateDocxFromTemplate('template/ministeriodaeducacao.docx');

        $docx->setTemplateSymbol('@');


        $presidente = Ministerio::where('cargo', '=', 'presidente')->get();
        foreach($presidente as $rows1) {
            $presidente1 = $rows1->nome;
        }
        $ministro = Ministerio::where('cargo', '=', 'ministro')->get();
        foreach($ministro as $rows2) {
            $ministro1 = $rows2->nome;
        }
        $sec_educ_prof_tecn = Ministerio::where('cargo', '=', 'sec_educ_prof_tecn')->get();
        foreach($sec_educ_prof_tecn as $rows3) {
            $sec_educ_prof_tecn1 = $rows3->nome;
        }
        $reitor = Ministerio::where('cargo', '=', 'reitor')->get();
        foreach($reitor as $rows4) {
            $reitor1 = $rows4->nome;
        }
        $pro_reitor_admin_plan = Ministerio::where('cargo', '=', 'pro_reitor_admin_plan')->get();
        foreach($pro_reitor_admin_plan as $rows5) {
            $pro_reitor_admin_plan1 = $rows5->nome;
        }
        $pro_reitor_ensino = Ministerio::where('cargo', '=', 'pro_reitor_ensino')->get();
        foreach($pro_reitor_ensino as $rows6) {
            $pro_reitor_ensino1 = $rows6->nome;
        }
        $pro_reitor_desenv_inst = Ministerio::where('cargo', '=', 'pro_reitor_desenv_inst')->get();
        foreach($pro_reitor_desenv_inst as $rows7) {
            $pro_reitor_desenv_inst1 = $rows7->nome;
        }
        $pro_reitor_posgrad_pesq_ino = Ministerio::where('cargo', '=', 'pro_reitor_posgrad_pesq_ino')->get();
        foreach($pro_reitor_posgrad_pesq_ino as $rows8) {
            $pro_reitor_posgrad_pesq_ino1 = $rows8->nome;
        }
        $pro_reitor_ext = Ministerio::where('cargo', '=', 'pro_reitor_ext')->get();

        foreach($pro_reitor_ext as $rows9) {
            $pro_reitor_ext1 = $rows9->nome;
        }
        $variables = array(
            'PRESIDENTE' => $presidente1,
            'MINISTRO'=> $ministro1,
            'SEC_EDUC_PROF_TECN'=>  $sec_educ_prof_tecn1,
            'REITOR'=>  $reitor1,
            'PRO_REITOR_ADMIN_PLAN'=>  $pro_reitor_admin_plan1,
            'PRO_REITOR_DESENV_INST'=> $pro_reitor_desenv_inst1,
            'PRO_REITOR_ENSINO'=> $pro_reitor_ensino1 ,
            'PRO_REITOR_EXT'=> $pro_reitor_ext1,
            'PRO_REITOR_POSGRAD_PESQ_INO'=> $pro_reitor_posgrad_pesq_ino1,
            );

        $docx->replaceVariableByText($variables);

        $docx->replacePlaceholderImage('BRASAO','img/brasao.jpg');// muda logo
    }

}
