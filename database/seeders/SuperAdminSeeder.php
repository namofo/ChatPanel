<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'soy@nader.com'],
            [
                'name' => 'Nader',
                'password' => Hash::make('tuContraseñaSegura')
            ]
        );
    }
}