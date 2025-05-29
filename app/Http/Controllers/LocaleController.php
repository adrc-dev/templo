<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function set(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|in:es,en,pt',
        ]);

        session(['locale' => $request->locale]);

        return redirect()->back()->with('success', ('Cambio de idioma exitoso'));
    }
}
