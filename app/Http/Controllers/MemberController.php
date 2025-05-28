<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Membership');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'recaptcha_token' => ['required', 'string'],
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('recaptcha_token'),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->with('error', 'La verificación de seguridad falló. Inténtalo de nuevo.');
        }

        // Guardar el comprobante
        $path = $request->file('payment_proof')->store('proofs', 'public');

        Member::create([
            'user_id' => auth()->id(),
            'payment_proof_path' => $path,
        ]);

        return back()->with('success', 'Tu solicitud fue enviada correctamente. Espera la revisión del administrador.');
    }
}
