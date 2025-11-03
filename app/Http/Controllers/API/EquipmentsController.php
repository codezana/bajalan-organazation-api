<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
    // Get a list of all equipments (GET /equipments)
    public function index()
    {
        $equipments = Equipment::all();
        return response()->json($equipments);
    }
    // Get details of a specific equipments (GET /equipments/{id})
    public function show($id)
    {
        $equipments = Equipment::find($id);
        if (!$equipments) {
            return response()->json(['message' => 'Equipments not found'], 404);
        }
        return response()->json($equipments);
    }

    // Create a new equipments (POST /equipments)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Create a new equipments using the validated data
        $equipments = Equipment::create($validatedData);

        // Check if the equipments was successfully created
        if ($equipments) {
            return response()->json(['success' => 'Equipments created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create Equipments'], 500);
        }
    }

    // Update an existing equipments (PUT /equipments/{id})
    public function update(Request $request, $id)
    {
        // Find the equipments by id or fail
        $equipments = Equipment::find($id);
        if (!$equipments) {
            return response()->json(['message' => 'Equipments not found'], 404);
        }

        // Log the current equipments data
        $updatedData = $request->merge(json_decode($request->getContent(), true));

        // Create an array with the updated data from the request
        $updatedData = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
        ];

        // Attempt to update the equipments with the new data
        if (!$equipments->update($updatedData)) {
            return response()->json(['message' => 'Failed to update Equipments'], 500);
        }

        return response()->json(['success' => 'Equipments updated successfully'], 200);
    }


    // Delete a equipments (DELETE /equipments/{id})
    public function destroy($id)
    {

        $equipments = Equipment::find($id);

        if (!$equipments) {
            return response()->json(['message' => 'Equipments not found'], 404);
        }

        $equipments->delete();

        return response()->json(['message' => 'Equipments deleted successfully']);
    }
}
