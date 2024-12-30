<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RecoveryRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use PhpParser\Node\Stmt\Echo_;

class ProfileController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::where('id', Auth::id())->first();
        // dd($user);

        return view('profile.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd('profile.edit');
        $userEdit = User::where('id', Auth::id())->first();

        return view('profile.edit', ['userEdit' => $userEdit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, string $id)
    {
        // dd('profile.update');
        $request->validated();

        DB::beginTransaction();

        try {
            $user = User::where('id', Auth::id())->first();

            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            Log::info('Usuário editado', ['id' => $user->id]);

            DB::commit();

            return redirect()->route('profile.show')->with('msgSuccess', 'Seu perfil foi editado e salvo com sucesso!');
        } catch (Exception $error) {
            Log::info('Perfil não editado', ['error' => $error->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('msgError', 'Ocorreu um erro ao editar o perfil.');
        }
    }

    public function passwordEdit(string $id)
    {
        // dd('user passwordUpdate');
        // dd($id);
        $userEdit = User::findOrFail($id);
        // dd($userEdit);

        if (!$userEdit) {
            return redirect()
                ->route('profile.show')
                ->with('msgError', 'Usuário não localizado.');
        }

        return view('profile.edit-password-profile', compact('userEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function passwordUpdate(ProfilePasswordRequest $request, string $id)
    {
        // dd('profile.update');
        $request->validated();

        DB::beginTransaction();

        try {
            $user = User::where('id', Auth::id())->first();

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            Log::info('Senha editada', ['id' => $user->id]);

            DB::commit();

            return redirect()->route('profile.show')->with('msgSuccess', 'Sua senha foi editada com sucesso!');
        } catch (Exception $error) {
            Log::info('Senha não editada', ['error' => $error->getMessage()]);

            DB::rollBack();

            return back()->withInput()->with('msgError', 'Ocorreu um erro ao editar a senha.');
        }
    }

    public function passwordRecovery()
    {
        // dd('profile.recovery');

        return view('login.recovery');
    }

    public function passwordRecoverySubmit(Request $request)
    {
        // dd($request);

        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'É necessário informar o e-mail para recuperar sua senha.',
            'email.email' => 'É necessário um e-mail válido.'
        ]);

        // Verify whether the user exists in the database.
        $checkIfUserEmailExists = User::where('email', $request->email)->first();

        if (!$checkIfUserEmailExists) {
            // Save log.
            Log::warning('Tentativa de recuperar senha com um e-mail não cadastrado.', [
                'email' => $request->email
            ]);

            // Redirect user.
            return back()->withInput()->with('msgError', 'O e-mail informado não está cadastrado.');
        }

        try {
            // Save token to recovery password and send an email.
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // Save log.
            Log::info('Recuperação de senha de acesso.', [
                'retorno' => $status,
                'email' => $request->email
            ]);

            // Redirect user after success.
            return redirect()
                ->route('root')
                ->with(
                    'msgSuccess',
                    'Verifique sua caixa de e-mail. Você receberá uma mensagem com  as instruções para recuperar sua senha de acesso.'
                );
        } catch (Exception $error) {
            // Save log.
            Log::warning('Erro ao recuperar sua senha.', [
                'error' => $error->getMessage(),
                'email' => $request->email
            ]);

            // Redirect user.
            return back()->withInput()->with('msgError', 'Por favor, tente novamente mais tarde.');
        }

        return view('login.index');
    }

    public function showResetPassword(Request $request)
    {
        // dd('Token: ' . $request->token);

        return view('login.resetPassword', [
            'token' => $request->token
        ]);
    }

    public function submitResetPassword(Request $request)
    {
        $messages = [
            'token.required' => 'O token é obrigatório para redefinir a senha.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], $messages);

        // dd($request);
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),

                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ]);

                    $user->save();
                }
            );

            Log::info('Senha atualizada', ['resposta' => $status, 'email' => $request->email]);

            return $status === Password::PASSWORD_RESET ?
                redirect()->route('root')->with('msgSuccess', 'Sua senha foi atualizada com sucesso!') :
                back()->withInput()->with('msgError', __($status));
        } catch (Exception $error) {
            Log::warning('Erro atualizar senha', ['error' => $error->getMessage(), 'email' => $request->email]);

            return back()->withInput()->with('msgError', 'Ocorreu um erro ao atualizar sua nova senha.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
