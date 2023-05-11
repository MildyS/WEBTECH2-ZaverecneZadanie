<?php

namespace App\Http\Controllers;

use App\Models\LatexFile;
use App\Models\Task;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $publishedFiles = LatexFile::where('is_published', true)->get();
        return view('student', compact('publishedFiles'));
    }

    public function startExam(Request $request)
    {
        $selectedFiles = $request->input('selected_files');

        $request->session()->put('selected_files', $selectedFiles);

        return redirect('student/exam');
    }

    public function showExam(Request $request)
    {
        // Get a random problem
        $task = Task::inRandomOrder()->first();

        // If no problem found (e.g., database is empty), redirect back to the student dashboard with an error message
        if(!$task) {
            return redirect()->route('student')->with('error', 'No problems available at the moment.');
        }

        // Pass the problem to the view
        return view('student.exam', ['task' => $task]);
    }

}
