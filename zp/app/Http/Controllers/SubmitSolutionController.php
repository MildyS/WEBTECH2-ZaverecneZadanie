<?php

namespace App\Http\Controllers;
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
        }

        return view('student.results', ['correctPoints' => $correctPoints, 'totalPoints' => $totalPoints]);
    }


}
