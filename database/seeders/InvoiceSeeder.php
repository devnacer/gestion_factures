<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoices')->insert([           
            'invoice_number' => 'INV-001',
            'invoice_Date' => '2024-05-01',
            'Due_date' => '2024-05-31',
            'product' => 'Product A',
            'section_id' => 1,
            'Amount_collection' => 1000,
            'Amount_Commission' => 100,
            'Discount' => 50,
            'Value_VAT' => 180,
            'Rate_VAT' => 18,
            'Total' => 1230,
            'Status' => 'paid',
            'Value_Status' => 1,
            'note' => 'Payment received.',
            'Payment_Date' => '2024-05-10',
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-002',
            'invoice_Date' => '2024-05-02',
            'Due_date' => '2024-06-01',
            'product' => 'Product B',
            'section_id' => 1,
            'Amount_collection' => 2000,
            'Amount_Commission' => 200,
            'Discount' => 100,
            'Value_VAT' => 360,
            'Rate_VAT' => 18,
            'Total' => 2280,
            'Status' => 'unpaid',
            'Value_Status' => 2,
            'note' => 'Payment pending.',
            'Payment_Date' => null,
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-003',
            'invoice_Date' => '2024-05-03',
            'Due_date' => '2024-06-02',
            'product' => 'Product A',
            'section_id' => 1,
            'Amount_collection' => 3000,
            'Amount_Commission' => 300,
            'Discount' => 150,
            'Value_VAT' => 540,
            'Rate_VAT' => 18,
            'Total' => 3330,
            'Status' => 'unpaid',
            'Value_Status' => 2,
            'note' => 'Payment pending.',
            'Payment_Date' => null,
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-004',
            'invoice_Date' => '2024-05-04',
            'Due_date' => '2024-06-03',
            'product' => 'Product A',
            'section_id' => 1,
            'Amount_collection' => 4000,
            'Amount_Commission' => 400,
            'Discount' => 200,
            'Value_VAT' => 720,
            'Rate_VAT' => 18,
            'Total' => 4440,
            'Status' => 'unpaid',
            'Value_Status' => 2,
            'note' => 'Payment pending.',
            'Payment_Date' => null,
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-005',
            'invoice_Date' => '2024-05-05',
            'Due_date' => '2024-06-04',
            'product' => 'Product B',
            'section_id' => 1,
            'Amount_collection' => 5000,
            'Amount_Commission' => 500,
            'Discount' => 250,
            'Value_VAT' => 900,
            'Rate_VAT' => 18,
            'Total' => 5550,
            'Status' => 'paid',
            'Value_Status' => 1,
            'note' => 'Payment received.',
            'Payment_Date' => '2024-05-15',
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-006',
            'invoice_Date' => '2024-05-06',
            'Due_date' => '2024-06-05',
            'product' => 'Product B',
            'section_id' => 1,
            'Amount_collection' => 6000,
            'Amount_Commission' => 600,
            'Discount' => 300,
            'Value_VAT' => 1080,
            'Rate_VAT' => 18,
            'Total' => 6660,
            'Status' => 'partially paid',
            'Value_Status' => 3,
            'note' => 'Payment partially .',
            'Payment_Date' => '2024-05-17',
        ]);

        DB::table('invoices')->insert([
            'invoice_number' => 'INV-007',
            'invoice_Date' => '2024-05-08',
            'Due_date' => '2024-06-05',
            'product' => 'Product A',
            'section_id' => 1,
            'Amount_collection' => 6000,
            'Amount_Commission' => 600,
            'Discount' => 300,
            'Value_VAT' => 1080,
            'Rate_VAT' => 18,
            'Total' => 6660,
            'Status' => 'partially paid',
            'Value_Status' => 3,
            'note' => 'Payment partially .',
            'Payment_Date' => '2024-05-19',
        ]);

    }
}
