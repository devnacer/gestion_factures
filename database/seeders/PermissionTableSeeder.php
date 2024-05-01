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
            'Invoices', //sidebar

            'Invoices List', //sidebar
            'Paid Invoices', //sidebar
            'Partially Paid Invoices', //sidebar
            'Unpaid Invoices', //sidebar 
            'Invoices Archive', //sidebar

            'Reports', //sidebar
            'Invoices Report', //sidebar
            'Customers Report', //sidebar

            'Users', //sidebar
            'Users List', //sidebar
            'Users Permissions', //sidebar

            'Settings',//sidebar
            'Products',//sidebar
            'Sections',// sidebar
            
            'Add Invoice', //
            'Edit Invoice', //
            'View Invoice',  //
            'Delete Invoice', //
            'Archive Invoice', //
            'Restore Invoice', //
            'Print Invoice',
                  
            'Open File Invoice', //
            'Download File Invoice', //

            'Export to Excel',
            'Change Payment Status', //
            'Add Attachment', //
            'Delete Attachment',
      
            'Add User', //
            'Edit User', //
            'Delete User', //
            
            'Users Rights List', //yes
            'View Role', //yes
            'Add Role', //yes
            'Edit Role', //yes
            'Delete Role', //yes
            
            'Product List', //
            'Add Product', //
            'Edit Product', //
            'Delete Product', //
            
            'Section List', //
            'Add Section', //
            'Edit Section', //
            'Delete Section', //

            'Notifications',            
            'home Page show',            
            ];
            
            foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            }
    }
}

