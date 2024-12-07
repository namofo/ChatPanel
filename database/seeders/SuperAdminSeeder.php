<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run()
{
    $user = User::firstOrCreate([
        'email' => env('SUPER_ADMIN_EMAIL', 'soy@nader.com'),
    ], [
        'name' => env('SUPER_ADMIN_NAME', 'Nader'),
        'password' => bcrypt(env('SUPER_ADMIN_PASSWORD', 'password')),
    ]);

    $role = Role::firstOrCreate(['name' => 'super_admin']);
    $user->assignRole($role);
}
}





