<?php

namespace App\Http\Controllers;

use App\Bibliografia;
use App\Curso;
use App\Disciplina;
use App\Ementario;
use Illuminate\Http\Request;


class EmentarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id,$iddisp)
    {

        $disciplina = Ementario::where('cursos_id', '=', $id)
            ->where('disciplinas_id', '=', $iddisp)
            ->first();

        $disciplinas_nome = Disciplina::where('id', '=', $iddisp) ->get();

        //    $disciplina = Ementario::select('id','disciplina')->get();
        //   $disciplina_nome = Ementario::pluck('disciplina', 'id');
        // $teste = ' ';
        $bibliografiabasico = Bibliografia::where('tipo', '=', 'basica')
            ->where('cursos_id', '=', $id)
            ->where('disciplinas_id', '=', $iddisp)
            ->with('livro')->get();

        $bibliografiacomplementar = Bibliografia::where('tipo', '=', 'complementar')
            ->where('cursos_id', '=', $id)
            ->where('disciplinas_id', '=', $iddisp)
            ->with('livro')->get();

        return view('cursos.ementario')
            ->with('disciplina', $disciplina)
            ->with('bibliografiacomplementar', $bibliografiacomplementar)
            ->with('bibliografiabasico', $bibliografiabasico)
            ->with('disciplinas_nome', $disciplinas_nome);


    }


    public function edit_ementario($id,$iddisp)
    {
        // $usuarios = Usuarios::findOrFail($id);
        //$categories = Categoria::where('parent_id', '=', 0)->get();
        //$allCategories = Categoria::pluck('title','id')->all();
        // $nomecurso = $id;
        //     $teste ='tiago';

        return view('cursos.ementario')

            ->with('teste', $teste);
    }

    public function rel_qtdperiodo($id,$docx){

        $docx->setTemplateSymbol('$');
        $curso = Curso::findOrFail($id);
        $qtd_periodo = $curso->qtd_periodo;

        if ($qtd_periodo == 4) {
            $docx->deleteTemplateBlock('QUINTOE');
            $docx->deleteTemplateBlock('SEXTOE');
            $docx->deleteTemplateBlock('SETIMOE');
            $docx->deleteTemplateBlock('OITAVOE');
            $docx->deleteTemplateBlock('NONOE');
            $docx->deleteTemplateBlock('DECIMOE');
        } elseif ($qtd_periodo == 5) {

            $docx->deleteTemplateBlock('SEXTOE');
            $docx->deleteTemplateBlock('SETIMOE');
            $docx->deleteTemplateBlock('OITAVOE');
            $docx->deleteTemplateBlock('NONOE');
            $docx->deleteTemplateBlock('DECIMOE');
        } elseif ($qtd_periodo == 6) {

            $docx->deleteTemplateBlock('SETIMOE');
            $docx->deleteTemplateBlock('OITAVOE');
            $docx->deleteTemplateBlock('NONOE');
            $docx->deleteTemplateBlock('DECIMOE');
        } elseif ($qtd_periodo == 7) {

            $docx->deleteTemplateBlock('OITAVOE');
            $docx->deleteTemplateBlock('NONOE');
            $docx->deleteTemplateBlock('DECIMOE');
        } elseif ($qtd_periodo == 8) {

            $docx->deleteTemplateBlock('NONOE');
            $docx->deleteTemplateBlock('DECIMOE');
        } elseif ($qtd_periodo == 9) {

            $docx->deleteTemplateBlock('DECIMOE');
        }
        $docx->clearBlocks();//limpa os blocos de txt não utilizado
    }

    public function rel_qtddisciplina($id,$docx)
    {

        $docx->setTemplateSymbol('$');

        $curso = Curso::findOrFail($id);

        $qtd_periodo = $curso->qtd_periodo;


        $i=1;
        while ($i <= $qtd_periodo){

            $periodo = Ementario::where('cursos_id', '=', $id)
                ->where('periodo', '=', $i)
                ->get([ 'id','disciplinas_id','ch', 'qtd_aula', 'periodo'])
                ->count();


            if($periodo == 1){

                $docx->deleteTemplateBlock('DISP'.$i.'2');
                $docx->deleteTemplateBlock('DISP'.$i.'3');
                $docx->deleteTemplateBlock('DISP'.$i.'4');
                $docx->deleteTemplateBlock('DISP'.$i.'5');
                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 2){

                $docx->deleteTemplateBlock('DISP'.$i.'3');
                $docx->deleteTemplateBlock('DISP'.$i.'4');
                $docx->deleteTemplateBlock('DISP'.$i.'5');
                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 3){

                $docx->deleteTemplateBlock('DISP'.$i.'4');
                $docx->deleteTemplateBlock('DISP'.$i.'5');
                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 4){

                $docx->deleteTemplateBlock('DISP'.$i.'5');
                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 5){

                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 6){

                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 7){

                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 8){

                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            elseif($periodo == 9){

                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            else{
                $docx->deleteTemplateBlock('DISP'.$i.'1');
                $docx->deleteTemplateBlock('DISP'.$i.'2');
                $docx->deleteTemplateBlock('DISP'.$i.'3');
                $docx->deleteTemplateBlock('DISP'.$i.'4');
                $docx->deleteTemplateBlock('DISP'.$i.'5');
                $docx->deleteTemplateBlock('DISP'.$i.'6');
                $docx->deleteTemplateBlock('DISP'.$i.'7');
                $docx->deleteTemplateBlock('DISP'.$i.'8');
                $docx->deleteTemplateBlock('DISP'.$i.'9');
                $docx->deleteTemplateBlock('DISP'.$i.'10');
            }
            $i++;
        }
    }

    public function rel_alimenta_ementario($id,$docx)
    {
        $curso = Curso::findOrFail($id);
        $qtd_periodo = $curso->qtd_periodo;

        for ($i = 1; $i <= $qtd_periodo; $i++) {

            $disciplina = Ementario::where('cursos_id', '=', $id)
                ->where('periodo', '=', $i)
                ->get([ 'id','ementa','disciplinas_id','ch', 'qtd_aula', 'periodo']);

            $j = 1;
            $docx->setTemplateSymbol('@');
            foreach($disciplina as $rows){

                $test = $rows->disciplinas_id;
                $referenciabasico = Bibliografia::where('disciplinas_id', '=', $test)
                    ->where('tipo', '=', 'basica')
                    ->where('cursos_id', '=', $id)
                    ->with('disciplina', 'livro')->get();

                foreach ($referenciabasico as $line2) {

                    $variables2 = array(
                        'BASICO' . $i .$j => $line2->tipo,
                    );
                    $docx->replaceVariableByText($variables2);
                }

                $referenciacomplementar = Bibliografia::where('disciplinas_id', '=', $test)
                    ->where('tipo', '=', 'complementar')
                    ->where('cursos_id', '=', $id)
                    ->with('disciplina', 'livro')->get();

                foreach ($referenciacomplementar as $line2) {

                    $variables2 = array(
                        'COMPLEMENTAR' . $i .$j => $line2->tipo,
                    );
                    $docx->replaceVariableByText($variables2);
                }


                $variables = array(
                    'disciplina' . $i .$j => $rows->disciplina->nome,
                    'EMENTA' . $i .$j => $rows->ementa,
                );
                $j ++;
                $docx->replaceVariableByText($variables);
            }
        }
    }
}
