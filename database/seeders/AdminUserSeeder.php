<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'surname' => 'Principal',
                'phone' => '+34123456789',
                'password' => Hash::make('adminadmin'),
                'role' => 'admin',
            ]
        );
    }
}
