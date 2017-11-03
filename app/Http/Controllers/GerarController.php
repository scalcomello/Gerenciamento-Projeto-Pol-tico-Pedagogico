<?php

namespace App\Http\Controllers;

use App\Corpo_docente;
use App\Documento;
use App\Ementario;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Curso;

class GerarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function download($id)
    {
      //--------------------CAPA--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/capa.docx');

        $capa = new CursoController();
        $capa->rel_capa($id, $docx);

        $ministerioeducacao = new Ministerio_da_educacaoController();
        $ministerioeducacao->rel_ministeriodaeducacao($docx);

        $conselhosuperior = new ConselhosuperiorController();
        $conselhosuperior->rel_conselhosuperior($docx);

        $diretorescampi = new Diretores_de_campiController();
        $diretorescampi->rel_diretorescampi($docx);

        $equipe_organizadora = new Equipe_organizadoraController();
        $equipe_organizadora->rel_equipeorganizadora($docx);

        $equipe_gestora = new Equipe_gestoraController();
        $equipe_gestora->rel_equipegestora($docx);

        $docx->createDocx(public_path() . '/newcapa.docx');

         //--------------------REITORIA--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/reitoria.docx');

        $caracterizacao = new Caracterizacao_institucionalController();
        $caracterizacao->rel_idreitoria($docx);

        $docx->createDocx(public_path() . '/newreitoria.docx');

        //--------------------MANTENEDORA--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/mantenedora.docx');

        $caracterizacao = new Caracterizacao_institucionalController();
        $caracterizacao->rel_idmantenedora($docx);

        $docx->createDocx(public_path() . '/newmantenedora.docx');

        //--------------------CAMPUS--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/campus.docx');

        $caracterizacao = new Caracterizacao_institucionalController();
        $caracterizacao->rel_idcampus($docx);

        $docx->createDocx(public_path() . '/newcampus.docx');

        //--------------------LEGISLACAO--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/legislacao.docx');

        $legislacao = new Legislacao_cursoController();
        $legislacao->rel_legislacao($id,$docx);

        $docx->createDocx(public_path() . '/newlegislacao.docx');

        //--------------------DADOS GERAIS--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/dadosgerais.docx');
        $capa = new CursoController();
        $capa->rel_dadosgerais($id, $docx);
        $docx->createDocx(public_path() . '/newdadosgerais.docx');

      //--------------------EMENTARIO--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/ementario.docx');

        $disciplinaementario = new EmentarioController();
        $disciplinaementario->rel_qtddisciplina($id,$docx);
        $disciplinaementario->rel_qtdperiodo($id,$docx);
        $disciplinaementario->rel_alimenta_ementario($id,$docx);

        $docx->createDocx(public_path() . '/newementario.docx');

       //--------------------MATRIZ--------------------//

        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/matriz.docx');
        $matriz = new Estrutura_curricularController();
        $matriz->rel_qtdperiodo($id,$docx);
        $matriz->rel_estruturacurricular_disciplina($id,$docx);
        $docx->createDocx(public_path() . '/newmatriz.docx');

        //--------------------CORPO DOCENTE--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/corpodocente.docx');
        $corpodocente = new Corpo_docenteController();
        $corpodocente->rel_corpodocente($id,$docx);

        $docx->createDocx(public_path() . '/newcorpodocente.docx');

        //--------------------CORPO ADMINISTRATIVO--------------------//
        $docx = new \Phpdocx\Create\CreateDocxFromTemplate(public_path() . '/estrutura/corpoadministrativo.docx');

        $corpodocente = new Corpo_administrativoController();
        $corpodocente->rel_administrativo($id,$docx);

        $docx->createDocx(public_path() . '/newcorpoadministrativo.docx');

       //--------------------CRIA NOVO DOCUMENTO--------------------//
        $docx = new \Phpdocx\Create\CreateDocx();//


        $docx->addExternalFile(array('src' => 'newcapa.docx'));

        $docx->addExternalFile(array('src' => 'sumario.docx'));

        $documento = Documento::with(array('subdocumento' => function($query){
            $query->orderBy('subordem','ASC');
        }))
            ->orderBy('ordem','ASC')
            ->where('status', '=', 'true')
            ->get();

        $wordStyles = array( '<h1>' => 'Heading1PHPDOCX' ,  '<h2>' => 'Heading2PHPDOCX','<h3>' => 'Heading3PHPDOCX','<h4>' => 'Heading4PHPDOCX');

        foreach ($documento as $rows) {
            $title = htmlentities($rows->titulo);
          //  $titu = '<h1>'.$title.'</h1><h><p>@titulo@</p>';

            //exeções para titulo
            if($rows->titulo == 'EMENTÁRIO'){
                $titu = '<h1>'.$title.'</h1><h>'.$rows->conteudo;
                $docx->embedHTML($titu, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                $docx->addExternalFile(array('src' => 'newementario.docx'));
            }
            else{
                $titu = '<h1>'.$title.'</h1><h>'.$rows->conteudo;
                $docx->embedHTML($titu, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
            }

         //exeções para subtitulo
            $len = count($rows->subdocumento);
            for ($i = 0; $i < $len; $i++) {
                $subtitle = htmlentities($rows->subdocumento[$i]->subtitulo);


                if($rows->subdocumento[$i]->subtitulo == 'IFSULDEMINAS – REITORIA'){
                    $sub= '<h2>'.$subtitle.'</h2>';
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                    $docx->addExternalFile(array('src' => 'newreitoria.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'ENTIDADE MANTENEDORA'){
                $sub= '<h2>'.$subtitle.'</h2>';
                   $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                $docx->addExternalFile(array('src' => 'newmantenedora.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'IDENTIFICAÇÃO DO CAMPUS MACHADO'){
                    $sub= '<h2>'.$subtitle.'</h2>';
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                    $docx->addExternalFile(array('src' => 'newcampus.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'LEGISLAÇÕES REFERENCIAIS PARA CONSTRUÇÃO DO PROJETO PEDAGÓGICO'){
                    $sub= '<h2>'.$subtitle.'</h2>';
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                    $docx->addExternalFile(array('src' => 'newlegislacao.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'IDENTIFICAÇÃO DO CURSO'){
                    $sub= '<h2>'.$subtitle.'</h2>';
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                    $docx->addExternalFile(array('src' => 'newdadosgerais.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'Matriz Curricular'){
                    $sub= '<h2>'.$subtitle.'</h2><h>'.$rows->subdocumento[$i]->descricao;
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                    $docx->addExternalFile(array('src' => 'newmatriz.docx'));
                }
                elseif($rows->subdocumento[$i]->subtitulo == 'Fluxograma do Curso'){
                    $sub= '<h2>'.$subtitle.'</h2><h>'.$rows->subdocumento[$i]->descricao;
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));

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
                }
                else{
                    $sub = '<h2>'.$subtitle.'</h2><h>'.$rows->subdocumento[$i]->descricao;
                    $docx->embedHTML($sub, array('strictWordStyles' => true, 'wordStyles' => $wordStyles));
                }
            }
        }

        $docx->createDocxAndDownload('pcc');
        // $docx->createDocx(public_path() . '/output.docx');
    }
}

