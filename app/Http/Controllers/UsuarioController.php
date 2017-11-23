<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Permission_role;
use App\Role;
use App\Role_user;
use App\User as Usuarios;
use Illuminate\Http\Request;
use Input, Redirect;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }

        public function index()
    {

        $users = Usuarios::with('perfil')->orderBy('name', 'asc')->get();

        return view('usuarios.usuarios')->with('usuarios', $users);

    }

    /**
     * @param Usuarios $user
     * @return mixed
     */
    public function permission()
    {

       $role1= DB::table('roles')->count();
       $role = Role::select('id','label')->get();

       $permission = Permission_role::select('permission_id','role_id','id')->with('role')->get();
        $permission_role = Permission_role::all();

        $permissionlist = Permission::pluck('label','id');
        $rolelist = Role::pluck('label','id');


        return view('usuarios.permissao')
            ->with('permission_role',$permission_role)
            ->with('permission',$permission)
            ->with('permissionlist',$permissionlist)
            ->with('rolelist',$rolelist)
            ->with('role',$role);


    }

    public function store_permission(Request $request)
    {

        $getTable = new Permission_role();
        $getTable->permission_id = $request->input('permission_id');
        $getTable->role_id = $request->input('role_id');
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Permissão concedida com sucesso!');
        return back();
    }


    public function destroy_permission($id)
    {
        $permission = Permission_role::findOrFail($id);

        $permission->delete();

        \Session::flash('mensagem_destroy', 'Permissão de acesso removida com sucesso!');
        return back();
    }




        public function create()
    {
        return view('usuarios.novousuario');
    }

        public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
        if($validator->fails()){
            return Redirect('usuarios/novo')
                ->withErrors($validator)
                ->withInput();
        }

        $getTable = new Usuarios();
        $getTable->name = $request->input('name');
        $getTable->foto = $request->input('foto');
        $getTable->email = $request->input('email');
        $getTable->perfil = $request->input('perfil');
        $getTable->password = bcrypt($request->input('password'));
        $getTable->save();

        \Session::flash('mensagem_sucesso', 'Usuário  cadastrado com sucesso!');
        return back();
    }

        public function edit($id)
    {
        $usuarios = Usuarios::findOrFail($id);
        return view('usuarios.novousuario', ['usuarios' => $usuarios]);
    }

        public function perfil($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.usuarioperfil', ['usuario' => $usuario]);

    }

        public function update($id, Request $request){
            $validator = validator($request->all(), [

                'name' => 'required|string|min:3|max:50',
                'password' => 'required|string|min:6|confirmed',


            ]);
            if($validator->fails()){
                return Redirect('usuarios/'.$id.'/editar')
                    ->withErrors($validator)
                    ->withInput();
            }

            $getTable = Usuarios::find($id);
            $getTable->name = $request->input('name');
            $getTable->foto = $request->input('foto');
            $getTable->email = $request->input('email');
            $getTable->perfil = $request->input('perfil');
            $getTable->password = bcrypt($request->input('password'));
            $getTable->save();

            \Session::flash('mensagem_update', 'Usuário atualizado com sucesso!');
            return back();

        }

        public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);

        $usuario->delete();

        \Session::flash('mensagem_destroy', 'Usuário removido com sucesso!');
        return back();
    }

    }
