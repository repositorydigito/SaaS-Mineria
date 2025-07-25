<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RegeneratePermissions extends Command
{
    protected $signature = 'shield:regenerate';
    protected $description = 'Regenerate all permissions and assign them to super_admin';

    public function handle()
    {
        // First, run the shield:generate command
        $this->call('shield:generate', [
            '--option' => 'policies_and_permissions'
        ]);

        // Get the super_admin role
        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // Get all permissions and assign them to super_admin
        $permissions = Permission::all();
        $role->syncPermissions($permissions);

        // Find admin user and ensure they have super_admin role
        $user = \App\Models\User::where('email', 'jcyr@admin.com')->first();
        if ($user) {
            $user->syncRoles(['super_admin']);
        }

        $this->info('Successfully regenerated all permissions and assigned them to super_admin role');
        $this->info('Total permissions: ' . $permissions->count());
        
        return 0;
    }
}
