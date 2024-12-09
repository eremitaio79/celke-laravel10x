<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Exception;
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

        /* withCount() returns number of classes in the relashionship. */
        $coursesList = Course::withCount('classe')->orderByDesc('id')->paginate(10);
        $totalCourses = $coursesList->total(); // Contagem total de courses

        // $coursesList = Course::where('status', 1)->orderByDesc('id')->paginate(5);
        // dd($coursesList);

        // return 'Course index method.';
        return view('course.index', [
            'coursesList' => $coursesList,
            'totalCourses' => $totalCourses,
        ]);
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
            'price' => $request->price,
            'image' => $request->image,
            // 'status' => $request->status ? 1 : 0
            'status' => $request->status
        ]);

        return redirect()->route('course.index')->with('msgSuccess', 'Curso cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $selectedCourse = Course::find($id);

        if (!$selectedCourse) {
            return redirect()->route('course.index')->with('msgError', 'Curso não encontrado.');
        }

        return view('course.show', compact('selectedCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editCourse = Course::find($id);

        if (!$editCourse) {
            return redirect()->route('course.index')->with('msgError', 'Curso não encontrado.');
        }

        return view('course.edit', compact('editCourse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);

        $course = Course::find($id);
        // dd($id);
        // dd($request);

        if (!$course) {
            return redirect()->route('course.index')->with('msgError', 'Curso não encontrado.');
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
            $course->update(['image' => $imagePath]);
        }

        return redirect()->route('course.show', $id)
            ->with('msgSuccess', 'O curso foi atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // dd($id);
            $course = Course::findOrFail($id);

            if (!$course) {
                return redirect()->route('course.index')->with('msgError', 'Curso não encontrado.');
            }

            $course->delete();

            return redirect()->route('course.index')->with('msgSuccess', 'O curso foi excluído com sucesso!');
        } catch (Exception $error) {
            // dd($error);
            return redirect()->route('course.index')->with('msgError', 'O curso não foi excluído pois contém aulas associadas a ele!');
        }
    }
}
