<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembershipRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva solicitud de membresía.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia('Membership');
    }

    /**
     * Almacena una nueva solicitud de membresía con el comprobante de pago.
     *
     * @param  \App\Http\Requests\MembershipRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MembershipRequest $request)
    {
        // Guardar el archivo del comprobante en el disco 'public' dentro de la carpeta 'proofs'
        $path = $request->file('payment_proof')->store('proofs', 'public');

        // Crear el registro de membresía asociado al usuario autenticado
        Member::create([
            'user_id' => auth()->id(),
            'payment_proof_path' => $path,
        ]);

        // Redirigir atrás con mensaje de éxito
        return back()->with('success', 'membership.request_sent');
    }

    /**
     * Elimina una membresía junto con su comprobante de pago.
     * Solo usuarios con rol admin u operador pueden realizar esta acción.
     *
     * @param  \App\Models\Member  $membership
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Member $membership)
    {
        // Comprobar permisos: solo admin u operador
        if (!auth()->user()->isAdmin() && !auth()->user()->isOperator()) {
            abort(403, 'No tienes permisos para esta acción');
        }

        // Eliminar archivo de comprobante si existe
        if ($membership->payment_proof_path) {
            Storage::disk('public')->delete($membership->payment_proof_path);
        }

        // Eliminar el registro de membresía
        $membership->delete();

        // Redirigir atrás con mensaje de éxito
        return redirect()->back()->with('success', 'membership.receipt_deleted');
    }
}
