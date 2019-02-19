<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')
                            ->paginate(10);

        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->get('password'));
        $user->save();

        Alert::success('Completado', 'Usuario registrado con exito.');
        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->name = $request->get('name');
        $user->birthdate = $request->get('birthdate');
        $user->email = $request->get('email');
        if (!$user->isAdmin()) {
            $user->status = $request->get('status');
        }

        $user->save();

        Alert::success('Completado', 'Usuario editado con exito.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            Alert::warning('Alerta', 'El usuario es administrador no pude ser eliminado.');
            return redirect()->route('admin.users.index');
        }
        $user->delete();
        Alert::success('Completado', 'Usuario eliminado con exito.');
        return redirect()->route('admin.users.index');
    }
}
