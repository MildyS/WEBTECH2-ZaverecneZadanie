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
        // Get the selected files from the session
        $selectedFiles = $request->session()->get('selected_files');

        // Initialize an empty array to hold the tasks
        $tasks = [];

        // For each selected file, get a random task
        foreach ($selectedFiles as $fileId) {
            // Get a random task from the current file
            $task = Task::where('latex_file_id', $fileId)->inRandomOrder()->first();

            // If no task found (e.g., all tasks from this file have been used), continue to the next file
            if(!$task) {
                continue;
            }

            // Add the task to the tasks array
            $tasks[] = $task;
        }

        // If no tasks found at all, redirect back to the student dashboard with an error message
        if(empty($tasks)) {
            return redirect()->route('student')->with('error', 'No problems available at the moment.');
        }

        // Pass the tasks to the view
        return view('student.exam', ['tasks' => $tasks]);
    }

}
