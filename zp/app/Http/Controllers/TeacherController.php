<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LatexFile;
use App\Models\ImageFile;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();

        $latexFiles = LatexFile::all();
        $images = ImageFile::where('user_id', auth()->user()->id)->get();

        return view('teacher', compact('students', 'latexFiles', 'images'));
    }

    public function addFiles()
    {
        $latexFiles = LatexFile::where('user_id', auth()->user()->id)->get();
        $images = ImageFile::where('user_id', auth()->user()->id)->get();
        return view('teacher.addFiles', compact('latexFiles', 'images'));
    }

    public function togglePublish($id)
    {
        $latexFile = LatexFile::findOrFail($id);

        if ($latexFile->is_published) {
            $latexFile->is_published = false;
        } else {
            if ($latexFile->publish_at && $latexFile->publish_at->isFuture()) {
                $latexFile->publish_at = null;
            }
            $latexFile->is_published = true;
        }

        $latexFile->save();

        return back();
    }

    public function setPublishDate(Request $request, $id)
    {
        $request->validate([
            'publish_at' => 'required|date|after:now',
        ]);

        $latexFile = LatexFile::findOrFail($id);
        $latexFile->publish_at = $request->publish_at;
        $latexFile->save();

        return back()->with('success', 'Publish date set successfully!');
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

        $path = $file->storeAs('public/latex_files', $fileName);

        $latexFile = new LatexFile;
        $latexFile->file_name = $fileName;
        $latexFile->file_path = $path;
        $latexFile->user_id = auth()->user()->id;
        $latexFile->save();

        return back()->with('success', 'File uploaded successfully!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $path = $request->image->storeAs('public/latex_files/images', $imageName);

        ImageFile::create([
            'user_id' => auth()->user()->id,
            'file_name' => $imageName,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Image uploaded and stored in the database successfully');
    }

    public function deleteFile($id)
    {
        $latexFile = LatexFile::findOrFail($id);

        if (Storage::delete($latexFile->file_path)) {
            $latexFile->delete();
            return back()->with('success', 'File deleted successfully!');
        } else {
            return back()->with('error', 'File deletion failed!');
        }
    }

    public function deleteImage($id)
    {
        $imageFile = ImageFile::findOrFail($id);

        if (Storage::delete($imageFile->file_path)) {
            $imageFile->delete();
            return back()->with('success', 'Image deleted successfully!');
        } else {
            return back()->with('error', 'Image deletion failed!');
        }
    }



}
