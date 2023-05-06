<?php

namespace App\Http\Controllers;

use App\Models\LatexFile;
class StudentController extends Controller
{
    public function index()
    {
        $publishedFiles = LatexFile::where('is_published', true)->get();
        return view('student', compact('publishedFiles'));
    }
}
