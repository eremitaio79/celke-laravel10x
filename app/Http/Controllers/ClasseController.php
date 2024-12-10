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
        // Obtém o maior valor de order_classe para o curso atual
        $lastOrder = Classe::where('course_id', $course->id)->max('order_classe');

        // Incrementa o valor ou define como 1 se não houver aulas
        $nextOrder = $lastOrder ? $lastOrder + 1 : 1;

        // Retorna a view com os dados necessários
        return view('classes.create', [
            'selectedCourse' => $course,  // Curso selecionado
            'nextOrder' => $nextOrder,    // Próxima ordem calculada
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ClasseRequest $classeRequest)
    {
        // Valida os dados recebidos.
        $classeRequest->validated();

        // Obtém o maior valor de `order_classe` para o curso específico.
        $lastOrder = Classe::where('course_id', $request->course_id)->max('order_classe');

        // Incrementa o valor para atribuir ao novo registro
        $nextOrder = $lastOrder ? $lastOrder + 1 : 1; // Se não houver registros, começa com 1.

        // Cria a nova aula com o próximo valor de ordem.
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'order_classe' => $nextOrder, // Atribui o próximo número.
            'image' => $request->image,
            'course_id' => $request->course_id,
        ]);

        return redirect()
            ->route('classe.index', ['course' => $request->course_id])
            ->with('msgSuccess', 'Aula cadastrada com sucesso!');
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
