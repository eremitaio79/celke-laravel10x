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

        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('order_classe', 'asc')->get();
        // dd($classes);

        return view('classes.index', [
            'classes' => $classes,
            'selectedCourse' => $course, // Passa o curso selecionado
        ]);
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
    public function create(Course $course)
    {
        // Use diretamente o curso passado pelo Route Model Binding
        $selectedCourse = $course->id;

        // dd($selectedCourse);

        return view('classes.create', ['selectedCourse' => $course]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('store');
        // dd($request);

        // PE79: Armazena todos os valores recebidos na tabela do banco de dados.
        // Course::create($request->all());

        // PE79: Armazena os dados nas colunas indicadas individualmente dentro de create.
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'order_classe' => $request->order_classe,
            'image' => $request->image,
            'course_id' => $request->course_id
        ]);

        return redirect()->route('classe.index', ['course' => $request->course_id])->with('msgSuccess', 'Curso cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Course $course)
    {
        $selectedClasse = Classe::with('course')->where('id', $id)->first();
        // dd($selectedClasse);

        if (!$selectedClasse) {
            return redirect()->route('classe.index')->with('msgError', 'Aula não encontrada.');
        }

        return view('classes.show', compact('selectedClasse'));
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
