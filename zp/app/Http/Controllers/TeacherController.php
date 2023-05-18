<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LatexFile;
use App\Models\ImageFile;
use Illuminate\Support\Facades\Storage;
use App\Models\FinishedFile;

use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function index()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();

        $studentData = [];

        foreach ($students as $student) {
            $filesGenerated = FinishedFile::where('user_id', $student->id)->count();
            $totalPoints = FinishedFile::where('user_id', $student->id)->sum('points');

            $studentData[] = [
                'id' => $student->id,
                'name' => $student->name,
                'filesGenerated' => $filesGenerated,
                'totalPoints' => $totalPoints,
            ];
        }

        $latexFiles = LatexFile::all();
        $images = ImageFile::where('user_id', auth()->user()->id)->get();

        return view('teacher', compact('students', 'latexFiles', 'images', 'studentData'));
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
            $latexFile->publish_at = null;
        } else {
            /*
            if ($latexFile->publish_at && $latexFile->publish_at->isFuture()) {
                $latexFile->publish_at = null;
            }*/
            $latexFile->publish_at = now();
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
        if ($latexFile->is_published){
            $latexFile->is_published = false;
        }
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
            'points' => 'required|integer'
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('public/latex_files', $fileName);

        $points = $request->input('points');

        $latexFile = new LatexFile;
        $latexFile->file_name = $fileName;
        $latexFile->file_path = $path;
        $latexFile->user_id = auth()->user()->id;
        $latexFile->save();

        $parsedContent = $this->latex_parser($file->get());

        foreach ($parsedContent as $content) {
            $task = new Task([
                'task' => $content['task'],
                'solution' => $content['solution'],
                'images' => json_encode($content['images']),  // Convert the array of image paths to a JSON string
                'points' => $points  // added points
            ]);
            $latexFile->tasks()->save($task);
        }

        return back()->with('success', 'File uploaded successfully!');
    }




    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = $request->image->getClientOriginalName();
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

    private function latex_parser($latex) {
        // Split into sections
        $sections = preg_split('/\\\\section\*\{.*?\}/', $latex);

        $tasks = [];

        foreach($sections as $section) {
            // Find tasks
            preg_match('/\\\\begin\{task\}(.*?)\\\\end\{task\}/s', $section, $taskMatches);

            // Find solutions
            preg_match('/\\\\begin\{solution\}(.*?)\\\\end\{solution\}/s', $section, $solutionMatches);


            if (isset($taskMatches[1])) {
                // Extract the image path from the task content.
                preg_match('/\\\\includegraphics\{(.*?)\}/', $taskMatches[1], $imageMatches);


                // Remove the image path from the task content.
                $task = preg_replace('/\\\\includegraphics\{(.*?)\}/', '', $taskMatches[1]);
                $task = preg_replace('/\\\\begin\{equation\*\}(.*?)\\\\end\{equation\*\}/s', '$ $1$', $task);
                $task = trim($task);


                $solution = '';
                if (isset($solutionMatches[1])) {
                    $solution = trim($solutionMatches[1]);
                }
                preg_match('/\\\\begin\{equation\*\}(.*?)\\\\end\{equation\*\}/s', $solutionMatches[1], $equationMatches);
                if (isset($equationMatches[1])) {
                    $solution = trim($equationMatches[1]);
                }

                // Extract the image path.
                $images = [];
                if (isset($imageMatches[1])) {
                    $images = $imageMatches[1];
                }


                $tasks[] = [
                    'task' => $task,
                    'solution' => $solution,
                    'images' => $images,
                ];
            }
        }

        return $tasks;
    }



}
