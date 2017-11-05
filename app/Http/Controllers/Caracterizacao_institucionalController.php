<?php

namespace App\Http\Controllers;

use App\Conteudo;
use Illuminate\Http\Request;
use App\Caracterizacao_institucional as Caracterizacao;
use Illuminate\Support\Facades\Redirect;


use Faker\Factory as Faker;


class Caracterizacao_institucionalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_identificacao()
    {
        $reitoria = Caracterizacao::where('tipo', '=','reitoria')->get();
        $mantenedora = Caracterizacao::where('tipo', '=','mantenedora')->get();
        $campi = Caracterizacao::where('tipo', '=','local_oferta')->get();
        return view('caracterizacaoinstitucional')
            ->with('mantenedora',$mantenedora)
            ->with('campi',$campi)
            ->with('reitoria',$reitoria);

    }

    public function index_caracterizacao()
    {
        $caracterizacao = Conteudo::where('tipo', 'caracterizacao')->first();
        $historico_campus = Conteudo::where('tipo', 'historico_campus')->first();

        return view('caracterizacao')
            ->with('historico_campus',$historico_campus)
            ->with('caracterizacao',$caracterizacao);
    }

    public function store(Request $request){

        $id = $request->input('id');
        $getTable = Conteudo::findOrFail($id);
        $getTable->conteudo = $request->input('conteudo');
        $getTable->save();
        \Session::flash('mensagem_sucesso', 'Salvo com sucesso!');
        return back();
    }

    public function index_historico()
    {
        $historico = Conteudo::where('tipo', 'historico')->first();
        return view('historico')
        ->with('historico',$historico);
    }

    public function edit($id)
    {
        $edit = Caracterizacao::findOrFail($id);

        $caracterizacao = Caracterizacao::all();

        //$reitoria = Caracterizacao::where('id', '=','1')->get();
        //$mantenedora = Caracterizacao::where('id', '=','2')->get();
        //$campi = Caracterizacao::where('id', '=','3')->get();

        return view('caracterizacaoinstitucional')->with('caracterizacao', $caracterizacao)
            ->with('edit', $edit);

    }

    function update($id, Request $request){



        $getTable = Caracterizacao::find($id);
        $getTable->nome_instituto = $request->input('nome_instituto');
        $getTable->cnpj = $request->input('cnpj');
        $getTable->nome_dirigente = $request->input('nome_dirigente');
        $getTable->endereco_instituto = $request->input('endereco_instituto');
        $getTable->bairro = $request->input('bairro');
        $getTable->cidade = $request->input('cidade');
        $getTable->uf = $request->input('uf');
        $getTable->cep = $request->input('cep');
        $getTable->telefone = $request->input('telefone');
        $getTable->fax = $request->input('fax');
        $getTable->email = $request->input('email');
        $getTable->denominacao = $request->input('denominacao');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro atualizado com sucesso!');
        return Redirect::to('caracterizacao_institucional');

    }

    function  rel_idreitoria($docx)
    {

        $docx->setTemplateSymbol('@');

        $reitoria = Caracterizacao::where('tipo', '=', 'reitoria')->first();

        $variables_reitoria = array(
            'NOME_INSTITUTO' => $reitoria->nome_instituto,
            'CNPJ' => $reitoria->cnpj,
            'NOME_DIRIGENTE' => $reitoria->nome_dirigente,
            'ENDERECO_INSTITUTO' => $reitoria->endereco_instituto,
            'BAIRRO' => $reitoria->bairro,
            'CIDADE' => $reitoria->cidade,
            'UF' => $reitoria->uf,
            'CEP' => $reitoria->cep,
            'TELEFONE' => $reitoria->telefone,
            'FAX' => $reitoria->fax,
            'EMAIL' => $reitoria->email,
        );

        $docx->replaceVariableByText($variables_reitoria);
    }

    function  rel_idmantenedora($docx)
        {
            $docx->setTemplateSymbol('@');
            $mantenedora = Caracterizacao::where('tipo', '=', 'mantenedora')->first();

            $variables_mantenedora = array(
                'NOME_INSTITUTO2' => $mantenedora->nome_instituto,
                'CNPJ2' => $mantenedora->cnpj,
                'NOME_DIRIGENTE2' => $mantenedora->nome_dirigente,
                'ENDERECO_INSTITUTO2' => $mantenedora->endereco_instituto,
                'BAIRRO2' => $mantenedora->bairro,
                'CIDADE2' => $mantenedora->cidade,
                'UF2' => $mantenedora->uf,
                'CEP2' => $mantenedora->cep,
                'TELEFONE2' => $mantenedora->telefone,
                'FAX2' => $mantenedora->fax,
                'EMAIL2' => $mantenedora->email,
                'DENOMINACAO' => $mantenedora->denominacao,
            );

            $docx->replaceVariableByText($variables_mantenedora);

        }

    function  rel_idcampus($docx){
        $docx->setTemplateSymbol('@');
        $campi = Caracterizacao::where('tipo', '=', 'local_oferta')->first();
        $variables_local_oferta = array(
            'NOME_INSTITUTO3' => $campi->nome_instituto,
            'CNPJ3' => $campi->cnpj,
            'NOME_DIRIGENTE3' => $campi->nome_dirigente,
            'ENDERECO_INSTITUTO3' => $campi->endereco_instituto,
            'BAIRRO3' => $campi->bairro,
            'CIDADE3' => $campi->cidade,
            'UF3' => $campi->uf,
            'CEP3' => $campi->cep,
            'TELEFONE3' => $campi->telefone,
            'FAX3' => $campi->fax,
            'EMAIL3' => $campi->email,
        );

        $docx->replaceVariableByText($variables_local_oferta);

    }

    function  rel_historico($docx){

       /* $historico = Conteudo::where('tipo', 'historico')->first();

        $variables1 = array(
            'TITULO_HISTORICO' => $historico->titulo

        );
        $docx->replaceVariableByText($variables1);

        //$docx->replaceVariableByHTML('TITULO_HISTORICO', 'inline', $historico->titulo);
        $docx->replaceVariableByHTML('CONTEUDO_HISTORICO', 'inline',  $historico->conteudo,array( 'downloadImages' => true));
*/
//create the Word fragment that is going to replace the variable

        $wf = new \Phpdocx\Elements\WordFragment($docx, 'document');
        $docx->setTemplateSymbol('@');
        $html= '<p>Em 2008 o Governo Federal ampliou o acesso &agrave; educa&ccedil;&atilde;o do pa&iacute;s com a cria&ccedil;&atilde;o dos Institutos Federais de Educa&ccedil;&atilde;o Ci&ecirc;ncia e Tecnologia. Atrav&eacute;s da Rede Federal de Educa&ccedil;&atilde;o Profissional e Tecnol&oacute;gica 31 Centros Federais de Educa&ccedil;&atilde;o Tecnol&oacute;gica (CEFETs), 75 Unidades Descentralizadas de Ensino (UNEDs), 39 Escolas Agrot&eacute;cnicas, 7 Escolas T&eacute;cnicas Federais e 8 escolas vinculadas a universidades deixaram de existir para formar os Institutos Federais de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia. No Sul de Minas, as Escolas Agrot&eacute;cnicas Federais de Inconfidentes, Machado e Muzambinho, tradicionalmente reconhecidas pela qualidade na oferta de ensino m&eacute;dio e t&eacute;cnico foram unificadas. Originou-se assim, o atual Instituto Federal de Educa&ccedil;&atilde;o, Ci&ecirc;ncia e Tecnologia do Sul de Minas Gerais - IFSULDEMINAS. Atualmente, al&eacute;m dos Campi de Inconfidentes, Machado, Muzambinho, os Campi de Pouso Alegre, Po&ccedil;os de Caldas, Passos e os campi avan&ccedil;ados de Tr&ecirc;s Cora&ccedil;&otilde;es e Carmo de Minas comp&otilde;em o IFSULDEMINAS e Polos de Rede nas cidades da regi&atilde;o. A Reitoria interliga toda a estrutura administrativa e educacional dos Campi. Sediada em Pouso Alegre, sua estrat&eacute;gica localiza&ccedil;&atilde;o, permite f&aacute;cil acesso aos Campi e unidades do IFSULDEMINAS, como observa-se no mapa apresentado na Figura.</p>

<p><img alt="" src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" style="height:400px; width:800px" /></p>';
//$docx->embedHTML($html);



        $wf->embedHTML($html);

        $docx->replaceVariableByWordFragment(array('CONTEUDO_HISTORICO' => $wf), array('type' => 'inline'));





    }

    function  rel_caracterizacao($docx){
        $caracterizacao = Conteudo::where('tipo', 'caracterizacao')->first();


        $variables2 = array(
            'TITULO_HISTORICO' => $caracterizacao->titulo

        );
        $docx->replaceVariableByText($variables2);

       // $docx->replaceVariableByHTML('TITULO_HISTORICO', 'inline', $caracterizacao->titulo);
        $docx->replaceVariableByHTML('CONTEUDO_HISTORICO', 'inline', $caracterizacao->conteudo);


        $historico_campus = Conteudo::where('tipo', 'historico_campus')->first();

        $variables3 = array(
            'HISTORICO_CAMPUS' =>$historico_campus->titulo

        );
        $docx->replaceVariableByText($variables3);

       // $docx->replaceVariableByHTML('HISTORICO_CAMPUS', 'inline', $historico_campus->titulo);
        $docx->replaceVariableByHTML('CONTEUDO_HISTORICO_CAMPUS', 'inline',  $historico_campus->conteudo);

    }

}
