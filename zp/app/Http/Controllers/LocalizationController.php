<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $language = $request->input('language');
        App::setLocale($language);

        return redirect()->back();
    }
}
