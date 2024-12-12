<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega a lista de usuários paginada, ordenada por nome.
        $userList = User::orderBy('name', 'asc')->paginate(10);
        $totalUsers = $userList->total(); // Contagem total de usuários.

        return view('users.index', [
            'userList' => $userList,
            'totalUsers' => $totalUsers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('User create');
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserRequest $userRequest)
    {
        // dd('User store');
        // dd($request);
        $userRequest->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Criptografando a senha
        ]);

        Log::info('PE79: Novo usuário cadastrado', [
            $userRequest
        ]);

        return redirect()->route('user.index')->with('msgSuccess', 'O novo usuário foi cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('User show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, User $user)
    {
        $userEdit = User::findorFail($id);
        // dd($userEdit);

        if (!$userEdit) {
            return redirect()->route('user.index')->with('msgError', 'Usuário não localizado.');
        }

        return view('users.edit', compact('userEdit'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UserRequest $userRequest)
    {
        // dd($id);
        $userRequest->validated();

        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()->route('user.index')->with('msgError', 'Usuário não encontrado.');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.show', $id)->with('msgSuccess', 'O usuário foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('User destroy');
    }
}
