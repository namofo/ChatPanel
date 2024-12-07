<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'create:superadmin';
    protected $description = 'Create a super admin user';

    public function handle()
    {
        User::firstOrCreate(
            ['email' => 'soy@nader.com'],
            [
                'name' => 'Nader',
                'password' => Hash::make('tuContraseñaSegura')
            ]
        );

        $this->info('Super admin created successfully');
    }
}