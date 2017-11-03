<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Input;
use PhpParser\Node\Expr\Array_;

class DocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($denominacao)
    {
        $documento = Documento::where('status', '=', 'true')->orderBy('ordem','ASC')->get();
        $nomecurso = Curso::find($denominacao);
        $curso = $denominacao;

        return view('cursos.documento') ->with('nomecurso', $nomecurso)
            ->with('curso', $curso)
            ->with('documento', $documento);

    }

    public function store_documento(Request $request)
    {
        $validator = validator($request->all(), [

            'titulo' => 'required|string|min:1|max:250',

        ]);
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $getTable = new Documento();
        $getTable->titulo = $request->input('titulo');
        $getTable->cursos_id = $request->input('cursos_id');
        $getTable->status = 'true';
        $getTable->save();
        return back()->with('success', 'Novo titulo adicionado com sucesso.');

    }

    public function atualizaordem()
    {

        $documento = Documento::where('status', '=', 'true')->orderBy('ordem','ASC')->get();
        $itemID = Input::get('itemID');
        $itemIndex = Input::get('itemIndex');

        foreach($documento as $item){
            return DB::table('documentos')->where('id','=',$itemID)->update(array('ordem'=> $itemIndex));
        }

    }

    public function edit_documento($curso,$id)
    {
        $nomecurso = Curso::find($curso);
        $documento = Documento::where('status', '=', 'true')->orderBy('ordem','ASC')->get();
        $edit = Documento::findOrFail($id);
        $curso = 1;
        return view('cursos.documento')
            ->with('nomecurso', $nomecurso)
            ->with('curso', $curso)
            ->with('documento', $documento)
            ->with('edit', $edit);
    }

    public function update_documento($curso,$id, Request $request)
    {
        $getTable = Documento::find($id);
        $getTable->titulo = $request->input('titulo');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro atualizado com sucesso!');
        return back()->with('success', 'Titulo atualizado com sucesso!');
    }

    public function destroy_documento($curso,$id)
    {

        $getTable = Documento::findOrFail($id);
        $getTable->status = 'false';
        $getTable->save();
        //$remover->delete();
        return back()->with('success', 'Titulo removido com sucesso!');
    }

    public function rel_documento($docx){




        $docx->setTemplateSymbol('@');


       // $wf = new \Phpdocx\Elements\WordFragment($docx, 'document');



       // $wf->addHeading('1',1);
      //  $wf->addHeading('1.2',2);
      //  $wf->addHeading('1.2.3',3);
       // $wf->addHeading('1.2.3.4',4);

      //  $docx->replaceVariableByHTML('TITULO', 'inline', '<p style="font-family: verdana; font-size: 11px">C/ Matías Turrión 24, Madrid 28043 <b>Spain</b></p>', array('isFile' => false, 'parseDivsAsPs' => true, 'downloadImages' => false));

        $html='<h1>teste</h1>';
        $wordStyles = array('<h1>' => 'titulo1');
        $docx->replaceVariableByHtml('TITULO', 'block', $html,  array('wordStyles' => $wordStyles));

/*
        //Conteudo 2.2
        $conteudo = Documento::where('ordem', '=', '2.2')->first();
        $wf = new \Phpdocx\Elements\WordFragment($docx, 'document');
        $docx->setTemplateSymbol('@');

        $html= $conteudo->conteudo;
        $wf->embedHTML($html);
        $docx->replaceVariableByWordFragment(array('CONTEUDO2.2' => $wf), array('type' => 'inline'));


        //Conteudo 3
        $conteudo3 = Documento::where('ordem', '=', '3')->first();
        $wf3 = new \Phpdocx\Elements\WordFragment($docx, 'document3');
        $docx->setTemplateSymbol('@');

        $html3= $conteudo3->conteudo;
        $wf3->embedHTML($html3);
        $docx->replaceVariableByWordFragment(array('CONTEUDO3' => $wf3), array('type' => 'inline'));


        $titulo3 = array(
            'TITULO3' => $conteudo3->titulo
        );
        $docx->replaceVariableByText($titulo3);
  */  }

}
