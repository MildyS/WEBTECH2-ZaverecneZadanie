<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LatexFile;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();

        $latexFiles = LatexFile::all();

        return view('teacher', compact('students', 'latexFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:tex|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        // Store the file information in the database
        $request->user()->latexFiles()->create([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);

        return back()
            ->with('success', 'File uploaded successfully.')
            ->with('file', $fileName);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:tex|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('latex_files', $fileName, 'public');

        $latexFile = new LatexFile;
        $latexFile->file_name = $fileName;
        $latexFile->file_path = $path;
        $latexFile->user_id = auth()->user()->id;
        $latexFile->save();

        return back()->with('success', 'File uploaded successfully!');
    }

}
