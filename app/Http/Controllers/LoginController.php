<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('');
    }

    /**
     * Process login.
     */
    public function loginProcess(Request $request, LoginRequest $loginRequest)
    {
        $loginRequest->validated();
        // dd($request);

        $authenticated = Auth::attempt([
            'email' => $loginRequest->email,
            'password' => $loginRequest->password
        ]);

        if (!$authenticated) {
            return back()
                ->withInput()
                ->with('msgError', 'Ocorreu um erro ao autenticar seus dados de acesso. Tente novamente.');
        }

        return redirect()
            ->route('home')
            ->with('msgSuccess', 'Autenticado com sucesso!');
    }

    /**
     * Open homepage after login.
     */
    public function home()
    {
        return view('homecelke');
    }

    /**
     * System logout.
     */
    public function logoutProcess()
    {
        Auth::logout();

        return redirect()->route('root')
            ->with('msgSuccess', 'Seu acesso foi encerrado com sucesso!');
    }

    public function createUser(User $user)
    {
        $newUser =
        // dd('create-user');

        return view('login.create');
    }

    public function storeUser()
    {
        dd('store user');
    }


}
