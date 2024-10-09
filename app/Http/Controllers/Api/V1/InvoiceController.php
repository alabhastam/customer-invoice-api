<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Display a listing of invoices
    public function index()
    {
        return response()->json(Invoice::all(), 200);
    }

    // Store a new invoice
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric',
            'invoice_date' => 'required|date',
        ]);

        $invoice = Invoice::create($validated);
        return response()->json($invoice, 201);
    }

    // Display a specific invoice
    public function show($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            return response()->json($invoice, 200);
        } else {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
    }

    // Update an existing invoice
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'amount' => 'required|numeric',
                'invoice_date' => 'required|date',
            ]);

            $invoice->update($validated);
            return response()->json($invoice, 200);
        } else {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
    }

    // Delete an invoice
    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            $invoice->delete();
            return response()->json(['message' => 'Invoice deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
    }
}
