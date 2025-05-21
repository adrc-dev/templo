<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RevokeExpiredMemberships extends Command
{
    protected $signature = 'memberships:revoke-expired';
    protected $description = 'Revoca sociedades vencidas';

    public function handle()
    {
        $now = Carbon::now();

        $users = User::where('role', 'socio')
            ->whereNotNull('membership_expires_at')
            ->where('membership_expires_at', '<', $now)
            ->get();

        foreach ($users as $user) {
            $user->role = 'user';
            $user->membership_expires_at = null;
            $user->save();

            $user->member()->where('status', 'active')->update(['status' => 'expired']);
        }

        $this->info("Se revocaron {$users->count()} membresías.");
    }
}
