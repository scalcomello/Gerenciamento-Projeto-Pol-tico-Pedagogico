<?php

namespace App\Http\Controllers;

use App\Bibliografia;
use App\Documento;
use App\Ementario;
use Illuminate\Http\Request;
use App\Legislacao;
use App\Curso;
use App\Legislacao_curso;

class Legislacao_cursoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($curso)
    {



        $qtd_periodo = 8;

        $i=1;
        while ($i <= $qtd_periodo) {
            $periodo = Ementario::where('cursos_id', '=', 1)
                ->where('periodo', '=', $i)
                ->get(['id', 'disciplinas_id', 'ch', 'qtd_aula', 'periodo']);

            foreach ($periodo as $rows) {
                echo $i.$rows->disciplina->nome;
                echo '<br>';
            }

           echo '<br>';

            $i++;
    }

/*
 *
 *      ->orderBy('ordem','ASC')
            ->orderBy('subordem','ASC')
        foreach ($documento as $rows){
            $subid = $rows->id;
            $subdocumento = Documento::where('status', '=', 'true')
                ->orderBy('ordem','ASC')->with('subdocumento')->get();

            echo '<br>';
        }*/


        /* $legislacao_curso = Legislacao_curso::select('id', 'legislacaos_id')->with('legislacao')->get();
         $legislacaos_lei = Legislacao::pluck('lei', 'id');




          return view('cursos.legislacao')->with('curso', $curso)
              ->with('legislacaos_lei', $legislacaos_lei)

              ->with('legislacao_curso', $legislacao_curso);
 */
    }

    public function store_legislacao(Request $request)
    {

        $getTable = new Legislacao_curso();
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->legislacaos_id = $request->input('legislacaos_id');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function destroy_legislacao($id)
    {
        $remover = Legislacao_curso::findOrFail($id);

        $remover->delete();
        \Session::flash('mensagem_sucesso', 'Cadastro removido com sucesso!');
        return back();
    }

    public function rel_legislacao($id,$docx)
    {

        $docx->setTemplateSymbol('@');

        $legislacao_curso = Legislacao_curso::select('legislacaos_id')->
            where('cursos_id', '=', $id)
            ->with('legislacao')->get();

        foreach ($legislacao_curso as $rows) {

            $lei['LEI'] = $rows->legislacao->lei;
            $ementa['EMENTA'] = $rows->legislacao->ementa;
            $result[] = array_merge($lei, $ementa);
        }

        $docx->replaceTableVariable($result, array('parseLineBreaks' => true));
    }

}
