<?php

namespace App\Http\Controllers;
use App\Models\FinishedFile;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;


class SubmitSolutionController
{

    public function submitSolution(Request $request)
    {
        Log::info('Reached submitSolution method.');

        $totalPoints = 0;
        $correctPoints = 0;
        $finishedFiles = [];

        foreach ($request->input('solution') as $taskId => $solution) {
            $task = Task::find($taskId);

            $totalPoints += $task->points;

            $process = new Process(['python3', 'compareLatex.py', $task->solution, $solution]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            if (trim($process->getOutput()) === 'True') {
                $correctPoints += $task->points;
            }

            // Store file_id associated with the task in array if not already stored
            if(!in_array($task->latexFile->id, $finishedFiles)) {
                array_push($finishedFiles, $task->latexFile->id);
            }
        }

        // Loop through each finished file and store in FinishedFile table
        foreach ($finishedFiles as $fileId) {
            FinishedFile::create([
                'user_id' => auth()->user()->id,
                'file_id' => $fileId,
                'points' => $correctPoints . '/' . $totalPoints
            ]);
        }

        return view('student.results', ['correctPoints' => $correctPoints, 'totalPoints' => $totalPoints]);
    }


}
