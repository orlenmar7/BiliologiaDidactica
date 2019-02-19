<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\FileBase6;
use Storage;

class AccountController extends Controller
{

    public function profile()
    {

        $user = auth()->user();

        return view('dashboard.account.profile')
            ->with('user', $user);
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

    public function updateAvatar(Request $request)
    {
        $user = auth()->user();

        $image = FileBase6::pullFile($request->get('image_url'), 'app/public/images/avatars/');

        $user->avatar = $image;

        $user->save();

        return response()->json([
            'title' => 'Completado',
            'message' => "Avatar actualizado con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'image' => $image,
        ], 201);

    }


}
