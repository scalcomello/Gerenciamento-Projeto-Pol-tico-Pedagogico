<?php

namespace App\Http\Controllers;

use App\Conteudo;
use Illuminate\Http\Request;
use App\Curso;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $curso = Curso::all();

        return view('cursos.curso')->with('curso', $curso);
    }

    public function store(Request $request)
    {

        $getTable = new Curso();
        $getTable->denominacao = $request->input('denominacao');
        $getTable->coordenador = $request->input('coordenador');
        $getTable->qtd_periodo = $request->input('qtd_periodo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('cursos');
    }

    public function form()
    {

        $curso = Curso::all();

        return view('cursos.curso')->with('curso', $curso);
    }

    public function gerenciar($id)
    {
        $curso = $id;
        $nomecurso = Curso::find($id);


        return view('cursos.gerenciar')->with('nomecurso', $nomecurso)
            ->with('curso', $curso);
    }

    public function componente()
    {

        $curso =  Curso::all();

       echo $curso;

        return view('cursos.componente')->with('curso', $curso);
    }

    function addconteudo(Request $request){


        $getTable = new Conteudo();
        $getTable->conteudo = $request->input('conteudo');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function rel_capa($id,$docx)
    {
        $getTable = Curso::find($id);


            $docx->setTemplateSymbol('@');

            $variables = array(
                'DENOMINACAO' => $getTable->denominacao,
                'CIDADE' => 'MACHADO',
                'ANO' => '2017',
                'UF' => 'MG',
            );

        $docx->replacePlaceholderImage('LOGO','img/logo.jpg');// muda logo

        $docx->replaceVariableByText($variables);

    }

    public function rel_dadosgerais($id,$docx)
    {
        $getTable = Curso::find($id);


        $docx->setTemplateSymbol('@');

        $variables = array('DENOMINACAO' => $getTable->denominacao,
            'CIDADE' => 'MACHADO',
            'ANO' => '2017',
            'UF' => 'MG',
            'COORDENADOR' => $getTable->coordenador,
            'DENOMINACAO_CURSO' => $getTable->denominacao,
            'TIPO' => $getTable->tipo,
            'MODALIDADE' => $getTable->modalidade,
            'AREA_CONHECIMENTO' => $getTable->area_conhecimento,
            'HABILITACAO' => $getTable->habilitacao,
            'TURNO' => $getTable->turno,
            'LOCAL_FUNCIONAMENTO' => $getTable->local_funcionamento,
            'ANO_IMPLEMENTACAO' => $getTable->ano_implementacao,
            'N_VAGAS' => $getTable->n_vagas,
            'FORMA_INGRESSO' => $getTable->forma_ingresso,
            'REQUISITOS_ACESSO' => $getTable->requisitos_acesso,
            'PERIODICIDADE_OFERTA' => $getTable->periodicidade_oferta,
            'QTD_ESTAGIO' => $getTable->qtd_estagio,
            'TEMPO_MIN' => $getTable->tempo_min,
            'TEMPO_MAX' => $getTable->tempo_max,
            'CH_TOTAL' => $getTable->ch_total,
        );

        $docx->replacePlaceholderImage('LOGO','img/logo.jpg');// muda logo

        $docx->replaceVariableByText($variables);

    }

}
