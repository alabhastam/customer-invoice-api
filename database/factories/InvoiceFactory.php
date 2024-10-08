<?php

namespace Database\Factories;


use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\nvoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),  // Link to a random customer
            'amount' => $this->faker->randomFloat(2, 10, 1000),  // Random amount between 10 and 1000
            'invoice_date' => $this->faker->date(),  // Random date
        ];
    }
}
