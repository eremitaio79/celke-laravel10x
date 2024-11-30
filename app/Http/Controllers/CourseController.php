<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * PE79: homepage from courses. Use 'index' method.
     */
    public function index()
    {
        // dd('List all courses in the table.');

        // return 'Course index method.';
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('CREATE VIEW');

        return view('course.create');
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
    public function show(string $id = null)
    {
        // dd('Show method loaded.');

        return view('course.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id = null)
    {
        // dd('EDIT VIEW');

        return view('course.edit');
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
