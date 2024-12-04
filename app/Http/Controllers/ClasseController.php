<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Course;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {

        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('id', 'desc')->get();
        // dd($classes);

        return view('classes.index', ['classes' => $classes]);
    }

    /**
     * Load all classes independet of the course.
     */
    public function allClasses()
    {
        $allClasses = Classe::orderBy('id', 'desc')->get();
        dd($allClasses);

        // return route('classe.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd('store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd('edit');
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
        dd('destroy/delete');
    }
}
