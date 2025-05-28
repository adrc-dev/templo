<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Member;

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
    public function store(MembershipRequest $request)
    {

        $path = $request->file('payment_proof')->store('proofs', 'public');

        Member::create([
            'user_id' => auth()->id(),
            'payment_proof_path' => $path,
        ]);

        return back()->with('success', 'Tu solicitud fue enviada correctamente. Espera la revisión del administrador.');
    }
}
