<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();

        return view('teacher', compact('students'));
    }
}
