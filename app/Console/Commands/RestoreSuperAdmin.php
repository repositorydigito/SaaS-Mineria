<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class RestoreSuperAdmin extends Command
{
    protected $signature = 'admin:restore-super-admin';
    protected $description = 'Restore super_admin role and assign it to the admin user';

    public function handle()
    {
        // Create super_admin role if it doesn't exist
        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // Find admin user and assign role
        $user = User::where('email', 'jcyr@admin.com')->first();

        if (!$user) {
            $this->error('Admin user not found!');
            return 1;
        }

        $user->syncRoles(['super_admin']);
        
        $this->info('Successfully restored super_admin role to ' . $user->email);
        return 0;
    }
}
