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
            return back()->withInput()->with('msgError', 'Ocorreu um erro ao autenticar seus dados de acesso. Tente novamente.');
        }

        return redirect()->route('home')->with('msgSuccess', 'Autenticado com sucesso!');
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

        return redirect()->route('root')->with('msgSuccess', 'Seu acesso foi encerrado com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
