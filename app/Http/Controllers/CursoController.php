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

    public function index_coordenacao($curso)
    {
        $curso = Curso::find($curso);

        return view('cursos.coordenacao')->with('curso', $curso);
    }



    public function create()
    {
        return view('cursos.novocurso');
    }

    public function store(Request $request)
    {

        $validator = validator($request->all(), [

           //validacao

        ]);
        if($validator->fails()){
            return Redirect('cursos/novo')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Curso();
        $getTable->denominacao = $request->input('denominacao');
        $getTable->coordenador = $request->input('coordenador');
        $getTable->qtd_periodo = $request->input('qtd_periodo');
        $getTable->tipo = $request->input('tipo');
        $getTable->modalidade  = $request->input('modalidade');
        $getTable->area_conhecimento  = $request->input('area_conhecimento');
        $getTable->habilitacao  = $request->input('habilitacao');
        $getTable->turno  = $request->input('turno');
        $getTable->local_funcionamento  = $request->input('local_funcionamento');
        $getTable->ano_implementacao  = $request->input('ano_implementacao');
        $getTable->n_vagas  = $request->input('n_vagas');
        $getTable->forma_ingresso  = $request->input('forma_ingresso');
        $getTable->requisitos_acesso  = $request->input('requisitos_acesso');
        $getTable->periodicidade_oferta  = $request->input('periodicidade_oferta');
        $getTable->qtd_estagio  = $request->input('qtd_estagio');
        $getTable->tempo_min  = $request->input('tempo_min');
        $getTable->tempo_max  = $request->input('tempo_max');
        $getTable->ch_total  = $request->input('ch_total');

        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Curso  criado com sucesso!');
        return back();
    }

    public function edit($id)
    {
        $curso = Usuarios::findOrFail($id);
        return view('cursos.novocurso', ['$curso' => $curso]);
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
