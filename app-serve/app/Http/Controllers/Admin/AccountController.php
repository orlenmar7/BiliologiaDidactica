<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountRequest;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\History;
use App\User;

class AccountController extends Controller
{

    public function profile()
    {

        $user = auth()->user();

        $counts =  [
            'histories' => History::orderBy('id', 'asc')->count(),
            'users' => User::orderBy('id', 'asc')->count(),
        ];

        return view('admin.account.profile')
            ->with([
                'user' => $user,
                'counts' => $counts
            ]);
    }

    public function update(AccountRequest $request)
    {
        $user = auth()->user();

        if ($request->get('current_password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->name = $request->get('name');
        $user->birthdate = $request->get('birthdate');
        $user->email = $request->get('email');

        $user->save();

        Alert::success('Completado', 'Su cuenta de usuario fue actualizada con exito.');
        return redirect()->back();
    }

}
