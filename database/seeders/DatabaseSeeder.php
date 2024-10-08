<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 customers, and for each customer, create 5 invoices
        Customer::factory(10)
            ->has(Invoice::factory()->count(5))  // Each customer will have 5 invoices
            ->create();
    }
}
