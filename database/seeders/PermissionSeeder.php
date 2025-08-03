<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define the master list of all possible permissions from your sidebar
        $permissions = [
            'view-dashboard', 'view-inquiries', 'manage-leads', 'access-data-records-menu',
            'create-data', 'import-data', 'view-data-groups', 'manage-quotations',
            'access-customers-menu', 'manage-customers', 'manage-customer-projects',
            'manage-domain-hosting', 'manage-payments-bills', 'manage-password-manager',
            'access-master-menu', 'manage-services', 'manage-service-categories',
            'manage-admin-access', 'manage-trusted-partners', 'manage-service-providers',
            'manage-roles', 'access-employees-menu', 'manage-employees',
            'manage-task-manager', 'manage-settings',
        ];

        // Create the permissions
        foreach ($permissions as $permissionSlug) {
            Permission::firstOrCreate([
                'slug' => $permissionSlug,
                'name' => ucwords(str_replace('-', ' ', $permissionSlug))
            ]);
        }

        // --- SAFEGUARD ---
        // Find the 'Admin' role and give it ALL permissions.
        // This ensures your main admin account can always manage everything.
        // All other roles will be managed via the UI.
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            // sync() will attach all permission IDs to the admin role.
            $adminRole->permissions()->sync(Permission::all()->pluck('id'));
        }
    }
}
