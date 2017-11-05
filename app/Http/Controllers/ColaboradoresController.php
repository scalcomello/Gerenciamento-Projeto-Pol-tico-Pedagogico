<?php

namespace App\Http\Controllers;
use App\Pessoa as Colaboradores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;

class ColaboradoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $colaboradores = Colaboradores::where('status', '=', 'on')->get(['id','nome','cargo']);
        //$colaboradores = Colaboradores::select(['id','nome','cargo']);

       //return Datatables::of($colaboradores)->make();
        return view('colaboradores')->with('colaboradores', $colaboradores);
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50|unique:pessoas'

        ]);
        if ($validator->fails()) {
            return Redirect('colaboradores')
                ->withErrors($validator)
                ->withInput();

        }

        $getTable = new Colaboradores();
        $getTable->nome = $request->input('nome');
        $getTable->cargo = $request->input('cargo');
        $getTable->status = 'on';
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Cadastro realizado com sucesso!');
        return Redirect::to('colaboradores');
    }

    public function edit($id)
    {
        $edit = Colaboradores::findOrFail($id);

        $colaboradores = Colaboradores::all();

        return view('colaboradores')->with('colaboradores', $colaboradores)
            ->with('edit', $edit);
    }

    public function update($id, Request $request)
    {
        $validator = validator($request->all(), [

            'nome' => 'required|string|min:3|max:50'

        ]);
        if ($validator->fails()) {
            return Redirect('colaboradores/' . $id . '/editar')
                ->withErrors($validator)
                ->withInput();
        }
        $getTable = Colaboradores::find($id);
        $getTable->nome = $request->input('nome');
        $getTable->cargo = $request->input('cargo');
        $getTable->save();

        \Session::flash('mensagem_update', 'Cadastro atualizado com sucesso!');
        return Redirect::to('colaboradores');

    }

    public function destroy($id)
    {

        $getTable = Colaboradores::findOrFail($id);
        $getTable->status = 'off';
        $getTable->save();
        //$remover->delete();
        \Session::flash('mensagem_destroy', 'Cadastro removido com sucesso!');
        return Redirect::to('colaboradores');
    }

}
