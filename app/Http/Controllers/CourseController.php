<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        $coursesList = Course::orderByDesc('id')->paginate(10);
        // $coursesList = Course::where('status', 1)->orderByDesc('id')->paginate(5);
        // dd($coursesList);

        // return 'Course index method.';
        return view('course.index', ['coursesList' => $coursesList]);
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
        // dd($request);

        // PE79: Armazena todos os valores recebidos na tabela do banco de dados.
        // Course::create($request->all());

        // PE79: Armazena os dados nas colunas indicadas individualmente dentro de create.
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            // 'status' => $request->status ? 1 : 0
            'status' => $request->status
        ]);

        return redirect()->route('course.index')->with('msgSuccess', 'Curso cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {
        $selectedCourse = Course::where('id', $id)->first();
        // dd($selectedCourse);

        return view('course.show', ['selectedCourse' => $selectedCourse]);
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
