<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;



class CustomerController extends Controller
{
    // Display a listing of customers
    public function index()
    {
        return response()->json(Customer::all(), 200);
    }

    // Store a new customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'nullable|string',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    // Display a specific customer
    public function show($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            return response()->json($customer, 200);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    // Update an existing customer
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $validated = $request->validate([
                'name' => 'sometimes|string',
                'email' => 'sometimes|email|unique:customers,email,'.$customer->id,
                'phone_number' => 'nullable|string',
            ]);

            $customer->update($validated);
            return response()->json($customer, 200);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }

    // Delete a customer
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Customer not found'], 404);
        }
    }
}