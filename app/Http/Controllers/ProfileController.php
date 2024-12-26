<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
