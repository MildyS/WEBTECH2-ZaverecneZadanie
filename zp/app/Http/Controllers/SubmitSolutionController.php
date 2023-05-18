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

        $correctAnswers = 0;
        Log::info($request->input('solution'));
        foreach ($request->input('solution') as $taskId => $solution) {
            $task = Task::find($taskId);

            $process = new Process(['python3', 'compareLatex.py', $task->solution, $solution]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            if (trim($process->getOutput()) === 'True') {
                $correctAnswers++;
            }
        }

        return view('student.results', ['correctAnswers' => $correctAnswers]);
    }


}
