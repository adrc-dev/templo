<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Member;
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
    public function store(MembershipRequest $request)
    {
        $path = $request->file('payment_proof')->store('proofs', 'public');

        Member::create([
            'user_id' => auth()->id(),
            'payment_proof_path' => $path,
        ]);

        return back()->with('success', 'membership.request_sent');
    }

    /**
     * Eliminar una membresía (recibo)
     */
    public function destroy(Member $membership)
    {
        // Verificar permisos
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'No tienes permisos para esta acción');
        }

        // Eliminar el archivo de comprobante
        if ($membership->payment_proof_path) {
            Storage::disk('public')->delete($membership->payment_proof_path);
        }

        $membership->delete();

        return redirect()->back()->with('success', 'membership.receipt_deleted');
    }
}
