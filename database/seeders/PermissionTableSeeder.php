<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Invoices',
            'Invoices List',
            'Paid Invoices',
            'Partially Paid Invoices',
            'Unpaid Invoices',
            'Invoices Archive',
            'Reports',
            'Invoices Report',
            'Clients Report',
            'Users',
            'Users List',
            'Users Permissions',
            'Settings',
            'Products',
            'Sections',
            
            'Add Invoice',
            'Delete Invoice',
            'Export to Excel',
            'Change Payment Status',
            'Edit Invoice',
            'Archive Invoice',
            'Print Invoice',
            'Add Attachment',
            'Delete Attachment',
            
            'Add User',
            'Edit User',
            'Delete User',
            
            'View Permission',
            'Add Permission',
            'Edit Permission',
            'Delete Permission',
            
            'Add Product',
            'Edit Product',
            'Delete Product',
            
            'Add Category',
            'Edit Category',
            'Delete Category',
            'Notifications',            
            ];
            
            foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            }
    }
}

