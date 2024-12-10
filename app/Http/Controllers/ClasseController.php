<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {

        // Conta o número de aulas para o curso específico
        $totalClasses = Classe::where('course_id', $course->id)->count();

        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('order_classe', 'asc')->get();
        // $totalClasses = $classes->total();
        // dd($classes);

        return view('classes.index', [
            'classes' => $classes,
            'selectedCourse' => $course, // Passa o curso selecionado.
            'totalClasses' => $totalClasses, // Passa a contagem das aulas.
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
    public function store(Request $request, ClasseRequest $classeRequest)
    {
        // dd('store');
        // dd($request);

        $classeRequest->validated();

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
    public function edit(Classe $classe, string $id)
    {
        // dd('edit');
        // dd($id);
        $selectedClasse = Classe::with('course')->where('id', $id)->first();
        // dd($selectedClasse);

        // Loading all courses.
        $courses = Course::all();
        // dd($courses);

        if (!$selectedClasse) {
            return redirect()->route('classe.index')->with('msgError', 'Aula não encontrada.');
        }

        return view('classes.edit', [
            'classeId' => $id,
            'selectedClasse' => $selectedClasse,
            'courses' => $courses // Sending course list for viewing.
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ClasseRequest $classeRequest)
    {
        // dd($request);
        // dd($id);

        $classeRequest->validated();

        // Validate the request data.
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'order_classe' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'course_id' => 'required|exists:courses,id',
        ]);

        $classe = Classe::findOrFail($id);

        if (!$classe) {
            return redirect()->route('classe.index')->with('msgError', 'Aula não encontrada.');
        }

        $classe->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'order_classe' => $request->order_classe,
            'image' => $request->image,
            'course_id' => $request->course_id
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('classes', 'public');
            $classe->update(['image' => $imagePath]);
        }

        return redirect()->route('classe.show', $id)->with('msgSuccess', 'A aula foi atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        try {
            // dd('destroy/delete');
            // dd($id);
            $classe->delete();

            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('msgSuccess', 'Aula excluída com sucesso!');
        } catch (Exception $error) {
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('msgError', 'Aula não excluída!');
        }
    }
}
