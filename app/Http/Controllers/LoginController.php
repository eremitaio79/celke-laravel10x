<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // dd('create-user');

        return view('login.create');
    }

    public function storeUser(LoginUserRequest $request)
    {
        $request->validated();
        // dd($request);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            // Save logo for success.
            Log::info('Sucesso ao cadastrar usuário', ['id' => $user->id]);

            // Commit new user record.
            DB::commit();

            // Finish and redirect to login view.
            return redirect()->route('root')->with('msgSuccess', 'Usuário cadastrado com sucesso!');

        } catch(Exception $error) {
            // Save log for error.
            Log::info('Erro ao cadastrar usuário', ['error' => $error->getMessage()]);

            // Rollback the database to the last change.
            DB::rollBack();

            return back()->withInput()->with('msgError', 'Erro ao cadastrar o novo usuário.');
        }
    }

}
