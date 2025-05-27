<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
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
        ]);

        $path = $request->file('payment_proof')->store('proofs', 'public');

        Member::create([
            'user_id' => auth()->id(),
            'payment_proof_path' => $path,
        ]);

        return back()->with('success', 'Tu solicitud fue enviada correctamente. Espera la revisión del administrador.');
    }
}
