<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create super_admin role if it doesn't exist
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Find your user and assign the role
        $user = User::where('email', 'jcyr@admin.com')->first();
        if ($user) {
            $user->assignRole('super_admin');
        }
    }
}
