<?php

namespace App\Http\Controllers;

use App\Models\FinishedFile;
use App\Models\LatexFile;
use App\Models\Task;
use App\Models\User;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ExportController
{
    public function exportCSV()
    {
        $tables = [
            'FinishedTasks' => FinishedFile::all(),
            'Users' => User::all(),
            'LatexFiles' => LatexFile::all(),
            'Tasks' => Task::all(),
        ];

        $zipFile = 'csv_exports/tables.zip';
        $zip = new ZipArchive;

        if ($zip->open(storage_path($zipFile), ZipArchive::CREATE) === true) {
            foreach ($tables as $tableName => $tableData) {
                $csvFile = $tableName . '.csv';
                $csvExport = fopen(storage_path('csv_exports/' . $csvFile), 'w');

                foreach ($tableData as $row) {
                    fputcsv($csvExport, $row->toArray());
                }

                fclose($csvExport);
                $zip->addFile(storage_path('csv_exports/' . $csvFile), $csvFile);
            }
            $zip->close();
        }

        return response()->download(storage_path($zipFile));
    }
}
