<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Decisions;
use Illuminate\Http\Request;

class DecisionsController extends Controller
{
    // Get a list of all decisions (GET /decisions)
    public function index()
    {
        $decisions = Decisions::all();
        return response()->json($decisions);
    }
    // Get details of a specific decisions (GET /decisions/{id})
    public function show($id)
    {
        $decisions = Decisions::find($id);
        if (!$decisions) {
            return response()->json(['message' => 'Decisions not found'], 404);
        }
        return response()->json($decisions);
    }

    // Create a new decisions (POST /decisions)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',  // Kurdish organization names can be customized
            'date' => 'required|date',
            'address' => 'required|string|max:255',
            'paragraph' => 'nullable',
        ]);

        // Create a new decisions using the validated data
        $decisions = Decisions::create($validatedData);

        // Check if the decisions was successfully created
        if ($decisions) {
            return response()->json(['success' => 'Decisions created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create Decisions'], 500);
        }
    }

    // Update an existing decisions (PUT /decisions/{id})
    public function update(Request $request, $id)
    {
        // Find the decisions by id or fail
        $decisions = Decisions::find($id);

        if (!$decisions) {
            return response()->json(['message' => 'Decisions not found'], 404);
        }
        // Log the current decisions data
        $updatedData = $request->merge(json_decode($request->getContent(), true));

        // Create an array with the updated data from the request
        $updatedData = [
            'name' => $request->name, 
            'date' => $request->date,
            'address' => $request->address,
            'paragraph' => $request->paragraph,
        ];

        // Attempt to update the decisions with the new data
        if (!$decisions->update($updatedData)) {
            return response()->json(['message' => 'Failed to update Decisions'], 500);
        }

        return response()->json(['success' => 'Decisions updated successfully'], 200);
    }


    // Delete a decisions (DELETE /decisions/{id})
    public function destroy($id)
    {

        $decisions = Decisions::find($id);

        if (!$decisions) {
            return response()->json(['message' => 'Decisions not found'], 404);
        }

        $decisions->delete();

        return response()->json(['message' => 'Decisions deleted successfully']);
    }
}
