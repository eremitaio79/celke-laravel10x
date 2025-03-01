<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception; // Importar explicitamente (não obrigatório, mas pode ajudar o editor)
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * ---------------------------------------------------------------------------------------------
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
     * ---------------------------------------------------------------------------------------------
     */
    public function create()
    {
        // dd('User create');
        // Retrieve the roles from the 'roles' table.
        // $roles = DB::table('permissions')->pluck('name')->all();
        $roles = DB::table('roles')->pluck('name')->all();
        // dd($roles);

        return view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * ---------------------------------------------------------------------------------------------
     */
    public function store(Request $request, UserRequest $userRequest)
    {
        // dd('User store');
        // dd($request);
        $userRequest->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password, ['rounds' => 10]), // Criptografando a senha com 10 saltos.
        ]);

        // User roles (nível de acesso do usuário).
        // $userRequest->assignRole($request->roles);
        $user->assignRole($request->roles);

        Log::info('PE79: Novo usuário cadastrado', [
            $userRequest
        ]);

        return redirect()
            ->route('user.index')
            ->with('msgSuccess', 'O novo usuário foi cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     * ---------------------------------------------------------------------------------------------
     */
    public function show(string $id)
    {
        // dd($id);
        $selectedUser = User::findOrFail($id);

        if (!$selectedUser) {
            return redirect()
                ->route('user.index')
                ->with('msgError', 'Usuário não encontrado.');
        }

        return view('users.show', compact('selectedUser'));
    }

    /**
     * Show the form for editing the specified resource.
     * ---------------------------------------------------------------------------------------------
     */
    public function edit(string $id, User $user)
    {
        $userEdit = User::findorFail($id);
        // dd($userEdit);

        // Recupera os níveis de acesso para os usuários (roles).
        $roles = DB::table('roles')->pluck('name')->all();
        // dd($roles);

        // Recupera o nível do usuário selecionado para edição.
        $userRoles = $userEdit->roles->pluck('name')->first();
        // dd($user);

        if (!$userEdit) {
            return redirect()
                ->route('user.index')
                ->with('msgError', 'Usuário não localizado.');
        }

        // return view('users.edit', compact('userEdit'));
        return view('users.edit', [
            'userEdit' => $userEdit,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * ---------------------------------------------------------------------------------------------
     */
    public function update(Request $request, string $id, UserRequest $userRequest)
    {
        // dd($id);
        $userRequest->validated();

        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()
                ->route('user.index')
                ->with('msgError', 'Usuário não encontrado.');
        }

        // The update operation happens here only for name and email fields.
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password)
        ]);

        // Salva o nível de acesso alterado do usuário selecionado.
        $user->syncRoles($request->roles);

        return redirect()
            ->route('user.show', $id)
            ->with('msgSuccess', 'O usuário foi atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * ---------------------------------------------------------------------------------------------
     */
    public function destroy(string $id, User $user)
    {        // dd('User destroy');
        // dd($id);
        try {
            // Busca o usuário ou lança uma exceção caso não exista
            $user = User::findOrFail($id);

            // Exclui o registro do usuário
            $user->delete();

            // Após excluir o usuário, remove todos os níveis atribuídos ao usuário excluído.
            $user->syncRoles([]);

            // Salvar o log.
            Log::info('Usuário excluído', [
                'id' => $user->id,
                'action_user_id' => Auth::id(),
            ]);

            // Redireciona com mensagem de sucesso
            return redirect()
                ->route('user.index')
                ->with('msgSuccess', 'O usuário foi excluído com sucesso!');
        } catch (Exception $error) {
            // Loga o erro para depuração (opcional)
            Log::error('Erro ao excluir usuário: ' . $error->getMessage());

            // Redireciona com mensagem de erro
            return redirect()
                ->route('user.index')
                ->with('msgError', 'Ocorreu um erro ao tentar excluir o usuário.
                    Por favor, tente novamente.');
        }
    }

    // ---------------------------------------------------------------------------------------------
    public function passwordEdit(string $id)
    {
        // dd('user passwordUpdate');
        // dd($id);
        $userEdit = User::findorFail($id);
        // dd($userEdit);

        if (!$userEdit) {
            return redirect()
                ->route('user.index')
                ->with('msgError', 'Usuário não localizado.');
        }

        return view('users.edit-password', compact('userEdit'));
    }

    // ---------------------------------------------------------------------------------------------
    public function passwordUpdate(Request $request, string $id, UserPasswordRequest $userPasswordRequest)
    {
        $userPasswordRequest->validated();

        $user = User::findOrFail($id);

        if (!$user) {
            return redirect()
                ->route('user.index')
                ->with('msgError', 'A senha do usuário não foi alterada.');
        }

        $user->update([
            // 'name' => $request->name,
            // 'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('user.show', $id)
            ->with('msgSuccess', 'A senha do usuário foi alterada com sucesso!');
    }
}
