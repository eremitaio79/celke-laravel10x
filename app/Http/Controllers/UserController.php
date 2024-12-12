<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        dd('User store');
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
    public function edit(string $id)
    {
        dd('User edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('User update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('User destroy');
    }
}
