<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class InstallShieldWithUser extends Command
{
    protected $signature = 'shield:setup';
    protected $description = 'Setup Filament Shield and create a default admin user';

    public function handle()
    {
        $this->info('Installing Filament Shield...');

        // Ejecutar instalación de Shield
        $this->call('shield:install', ['--fresh' => true]);

        // Crear un usuario admin
        $name = 'Alberto';
        $email = 'soy@beto.com';
        $password = '15df45df12fg1M';

        $this->info('Creating admin user...');
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('super_admin');

        $this->info('Admin user created successfully!');
        $this->info("Name: $name");
        $this->info("Email: $email");

        return 0;
    }
}
