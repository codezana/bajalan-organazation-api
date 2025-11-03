<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
      // Get a list of all accounting (GET /accounting)
      public function index()
      {
          $accounting = Accounting::all();
          return response()->json($accounting);
      }
      // Get details of a specific accounting (GET /accounting/{id})
      public function show($id)
      {
          $accounting = Accounting::find($id);
          if (!$accounting) {
              return response()->json(['message' => 'Accounting not found'], 404);
          }
          return response()->json($accounting);
      }
  
      // Create a new accounting (POST /accounting)
      public function store(Request $request)
      {
          // Validate the incoming request data
          $validatedData = $request->validate([
            'date' => 'required|date',
            'amount_received' => 'required|numeric',
            'address_received' => 'required|string|max:255',
            'amount_paid' => 'required|numeric',
            'address_paid' => 'required|string|max:255',
            'balance' => 'required|numeric',
          ]);
    
          // Create a new accounting using the validated data
          $accounting = Accounting::create($validatedData);
  
          // Check if the accounting was successfully created
          if ($accounting) {
              return response()->json(['success' => 'Accounting created successfully'], 201);
          } else {
              return response()->json(['error' => 'Failed to create Accounting'], 500);
          }
      }
  
      // Update an existing accounting (PUT /accounting/{id})
      public function update(Request $request, $id)
      {
          // Find the accounting by id or fail
          $accounting = Accounting::find($id);
  
          if (!$accounting) {
              return response()->json(['message' => 'Accounting not found'], 404);
          }
          // Log the current accounting data
          $updatedData=$request->merge(json_decode($request->getContent(), true));
  
          // Create an array with the updated data from the request
          $updatedData = [
            'date' => $request->date,
            'amount_received' => $request->amount_received,
            'address_received' => $request->address_received,
            'amount_paid' => $request->amount_paid,
            'address_paid' => $request->address_paid,
            'balance' => $request->balance,
          ];
  
          // Attempt to update the accounting with the new data
          if (!$accounting->update($updatedData)) {
              return response()->json(['message' => 'Failed to update Accounting'], 500);
          }
  
          return response()->json(['success' => 'Accounting updated successfully'], 200);
      }
  
  
      // Delete a accounting (DELETE /accounting/{id})
      public function destroy($id)
      {
  
          $accounting = Accounting::find($id);
  
          if (!$accounting) {
              return response()->json(['message' => 'Accounting not found'], 404);
          }
  
          $accounting->delete();
  
          return response()->json(['message' => 'Accounting deleted successfully']);
      }
}
