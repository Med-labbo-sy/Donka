<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        if (!in_array($locale, ['fr', 'ar', 'en'])) abort(400);
        session(['locale' => $locale]);
        return back();
    }
}