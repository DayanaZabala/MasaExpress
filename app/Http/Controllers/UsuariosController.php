<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;
use Auth;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('administrador'))
        {
            //abort(403);
            return redirect()->route('usuarios.index');

        }
        $usuarios = User::orderBy('name', 'asc')
                        ->get();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if(Gate::denies('administrador'))
        {
            abort(403);

        }

        $usuario = User::findOrFail($id);
        $rolesUsuario = DB::select("select * from rol_user where user_id = $id");
        $roles = Rol::orderBy('nombre', 'asc')
                        ->get();
        return view('usuario.edit', compact('usuario', 'rolesUsuario', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(Auth::user()->id != $id)
        {
            // Asignando los datos
            if($request->rol != null)
            {
                $user->roles()->sync($request->rol);
            }
            else {
                $user->roles()->sync(1);
            }
            $user->save();
        }
        else {
            return redirect()->route('usuarios.index')
                            ->with('warning', 'No puede modificar sus propios datos');
        }
        
        return redirect()->route('usuarios.index')
                        ->with('exito', 'Datos modificados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}