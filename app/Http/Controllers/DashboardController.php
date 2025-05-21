<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query
            ->with('members')
            ->orderBy('id', 'asc')
            ->paginate(25)
            ->withQueryString();

        return Inertia::render('Dashboard/Index', [
            'users' => $users,
            'authRole' => auth()->user()->role,
        ]);
    }
}
