<?php

namespace App\Http\Controllers;
use PDF;

class ManualController
{

    public function show()
    {
        return view('manual');
    }

    public function generatePDF()
    {
        $pdf = PDF::loadView('manual');
        return $pdf->download('manual.pdf');
    }

}
