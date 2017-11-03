<?php

namespace App\Http\Controllers;

use App\Bibliografia;
use App\Disciplina;
use Khill\Lavacharts\Lavacharts;
use App\Componentecurricular;
use Illuminate\Http\Request;
use App\Ementario;
use App\Curso;
use Charts;

use Illuminate\Support\Facades\Redirect;


class Estrutura_curricularController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        //$disciplina = Ementario::where('cursos_id', '=', $id)->where('periodo', '=', '2')->get(['id', 'disciplina', 'ch', 'qtd_aula', 'periodo']);

        $disciplinas_nome = Disciplina::pluck('nome','id');

        $idcurso = $id;
        $total_ch[] = 0;
        $total_qtd_aula[] = 0;
        $disciplina = Ementario::all();

        $curso = Curso::find($id);
        $periodo = $curso->qtd_periodo;

        for ($j = 1; $j <= $periodo; $j++) {

            $total_ch[$j] = Ementario::where('periodo', $j)
                ->sum('ch');
            $total_qtd_aula[$j] = Ementario::where('periodo', $j)
                ->sum('qtd_aula');
        }

        $componentecurricular = Componentecurricular::where('cursos_id', $id)->get();
        $chg[] = 0;
        $descg[] = 0;
        $sigla[] = 0;
        foreach ($componentecurricular as $rows) {

            $chg[] = $rows->cargahoraria;
            $descg[] = $rows->descricao;
            $sigla[] = $rows->sigla;
        }


        $chart = Charts::create('pie', 'highcharts')
            ->colors(['#1E90FF', '#C71585', '#3CB371', '#40E0D0', '#FFD700', '#66CDAA', '#FF7F50', '#FF0000'])
            ->title('Carga Horária')
            ->labels($sigla)
            ->values($chg)
            ->dimensions(620, 500)
            ->responsive(true);


        return view('cursos.estrutura_curricular')
            ->with('curso', $curso)
            ->with('disciplina', $disciplina)
            ->with('idcurso', $idcurso)
            ->with('componentecurricular', $componentecurricular)
            ->with('periodo', $periodo)
            ->with('total_ch', $total_ch)
            ->with('total_qtd_aula', $total_qtd_aula)
            ->with('disciplinas_nome', $disciplinas_nome)
            ->with('chart', $chart);

    }

    public function store_disciplina(Request $request)
    {
        $validator = validator($request->all(), [

            'qtd_aula' => 'required',

        ]);
        if($validator->fails()){
            return Redirect::back()->with('error_code', true)
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Ementario();
        $getTable->disciplinas_id = $request->input('disciplinas_id');
        $getTable->ch = $request->input('ch');
        $getTable->qtd_aula = $request->input('qtd_aula');
        $getTable->periodo = $request->input('periodo');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function store_componente(Request $request)
    {

        $getTable = new Componentecurricular();
        $getTable->descricao = $request->input('descricao');
        $getTable->cargahoraria = $request->input('cargahoraria');
        $getTable->sigla = $request->input('sigla');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return back();
    }

    public function edit_disciplina($id, Request $request)
    {
        $disciplina = Ementario::findOrFail($id);
        $disciplinas_nome = Disciplina::pluck('nome','id');

        return view('cursos.estrutura_curricular')
            ->with('disciplina', $disciplina)
        ->with('disciplinas_nome', $disciplinas_nome);

       // return Redirect::to('cursos.estrutura_curricular');
    }

    public function edit_componente($id, Request $request)
    {

        $componente = Componentecurricular::findOrFail($id);
        return view('cursos.estrutura_curricular', ['componente' => $componente]);

    }

    public function update_disciplina($id, Request $request)
    {

        $getTable = Ementario::find($id);
        $getTable->disciplinas_id = $request->input('disciplinas_id');
        $getTable->ch = $request->input('ch');
        $getTable->qtd_aula = $request->input('qtd_aula');
        $getTable->periodo = $request->input('periodo');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();

        return back();
    }

    public function update_componente($id, Request $request)
    {

        $getTable = Componentecurricular::find($id);
        $getTable->descricao = $request->input('descricao');
        $getTable->cargahoraria = $request->input('cargahoraria');
        $getTable->sigla = $request->input('sigla');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->save();

        return back();
    }

    public function destroy_componente($id)
    {
        $componente = Componentecurricular::findOrFail($id);

        $componente->delete();

        \Session::flash('mensagem_sucesso', 'Usuário removido com sucesso!');
        return back();
    }

    public function destroy_disciplina($id)
    {
        $usuario = Ementario::findOrFail($id);

        $usuario->delete();

        \Session::flash('mensagem_sucesso', 'Usuário removido com sucesso!');
        return back();
    }

    public function rel_estruturacurricular_disciplina($id,$docx)
    {

        $curso = Curso::findOrFail($id);

        $qtd_periodo = $curso->qtd_periodo;

        $docx->setTemplateSymbol('@');
        //$disciplina = Ementario::where('cursos_id', '=', $id)->get(['id','disciplina','ch','qtd_aula','periodo']);
        // $curso = Curso::findOrFail($id);
        // $qtd_periodo = $curso->qtd_periodo;
        $i=1;
        while ($i <= $qtd_periodo) {
            $periodo = Ementario::where('cursos_id', '=', $id)
                ->where('periodo', '=', $i)
                ->get(['id', 'disciplinas_id', 'ch', 'qtd_aula', 'periodo']);


            foreach ($periodo as $rows) {
                $discip['DISCIPLINA'.$i] = $rows->disciplina->nome;
                $ch['CH'.$i] = $rows->ch;
                $qtd_aula['AULAS'.$i] = $rows->qtd_aula;
                $result[] = array_merge($discip, $ch, $qtd_aula);
            }
            $docx->replaceTableVariable($result, array('parseLineBreaks' => true));
            $i++;
            unset($result);
        }


    }

    public function rel_estruturacurricular_grafico($id,$docx)
    {
        $getTable = Curso::find($id);

        $docx->setTemplateSymbol('@');

        $variables = array('DENOMINACAO_CURSO_GRAF' => $getTable->denominacao);

        $docx->replaceVariableByText($variables);

        $content = new \Phpdocx\Elements\WordFragment($docx, 'document');
        $data = array(
            'Legend 1' => array(20),
            'Legend 2' => array(30),
            'Legend 3' => array(40)
        );
        $paramsChart = array(
            'data' => $data,
            'type' => 'pieChart',
            'rotX' => 20,
            'rotY' => 20,
            'perspective' => 30,
            'color' => 2,
            'sizeX' => 10,
            'sizeY' => 5,
            'chartAlign' => 'center',
            'showPercent' => 1,
        );
        $content->addChart($paramsChart);
        $referenceNode = array(
            'contains' => 'GRAFICO',
        );
        $docx->replaceWordContent($content, $referenceNode);
        //$docx->createDocx('example_replaceWordContent_2');
    }

    public function rel_ementario_disciplina($docx)
    {
        //$docx->setTemplateSymbol('@');
        //$disciplina = Ementario::where('cursos_id', '=', $id)->get(['id','disciplina','ch','qtd_aula','periodo']);
        // $curso = Curso::findOrFail($id);
        // $qtd_periodo = $curso->qtd_periodo;

        $periodo = Ementario::where('cursos_id', '=', 1)
            ->where('periodo', '=', 1)
            ->get([ 'id','disciplinas_id','ch', 'qtd_aula', 'periodo'])
          ;

        foreach ($periodo as $rows) {
            $discip['DISCIPLINA1'] = $rows->disciplina->nome;
            $ch['CH1'] = $rows->ch;
            $qtd_aula['AULAS1'] = $rows->qtd_aula;
            $result[] = array_merge($discip, $ch, $qtd_aula);
        }
        $docx->replaceTableVariable($result, array('parseLineBreaks' => true));
    }

    public function rel_qtdperiodo($id,$docx)
    {
        $docx->setTemplateSymbol('$');
        $curso = Curso::findOrFail($id);
        $qtd_periodo = $curso->qtd_periodo;

        if ($qtd_periodo == 4) {
            $docx->deleteTemplateBlock('QUINTO');
            $docx->deleteTemplateBlock('SEXTO');
            $docx->deleteTemplateBlock('SETIMO');
            $docx->deleteTemplateBlock('OITAVO');
            $docx->deleteTemplateBlock('NONO');
            $docx->deleteTemplateBlock('DECIMO');

        } elseif ($qtd_periodo == 5) {
            $docx->deleteTemplateBlock('SEXTO');
            $docx->deleteTemplateBlock('SETIMO');
            $docx->deleteTemplateBlock('OITAVO');
            $docx->deleteTemplateBlock('NONO');
            $docx->deleteTemplateBlock('DECIMO');

        } elseif ($qtd_periodo == 6) {
            $docx->deleteTemplateBlock('SETIMO');
            $docx->deleteTemplateBlock('OITAVO');
            $docx->deleteTemplateBlock('NONO');
            $docx->deleteTemplateBlock('DECIMO');

        } elseif ($qtd_periodo == 7) {
            $docx->deleteTemplateBlock('OITAVO');
            $docx->deleteTemplateBlock('NONO');
            $docx->deleteTemplateBlock('DECIMO');

        } elseif ($qtd_periodo == 8) {
            $docx->deleteTemplateBlock('NONO');
            $docx->deleteTemplateBlock('DECIMO');

        } elseif ($qtd_periodo == 9) {
            $docx->deleteTemplateBlock('DECIMO');
   ;
        }
        $docx->clearBlocks();//limpa os blocos de txt não utilizado
    }

}
