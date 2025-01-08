<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role; // Use o namespace correto

class RoleController extends Controller
{
    // Constructor.
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-role', [
            'only' => 'index' // Somente o método index pode ser acessado.
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('role.index');
        // $roles = Role::orderByDesc('name')->paginate(40);
        $roles = Role::orderBy('name')->paginate(40); // Ascedent ordering.

        // Salva o log.
        Log::info('Listar níveis de acesso', ['action_user_id' => Auth::id()]);

        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('role.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd('role.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd('role.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd('role.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd('role.destroy');
    }
}
