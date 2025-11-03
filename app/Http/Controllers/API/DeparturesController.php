<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Departures;
use Illuminate\Http\Request;

class DeparturesController extends Controller
{
    // Get a list of all departures (GET /departures)
    public function index()
    {
        $departures = Departures::all();
        return response()->json($departures);
    }
    // Get details of a specific departures (GET /departures/{id})
    public function show($id)
    {
        $departures = Departures::find($id);
        if (!$departures) {
            return response()->json(['message' => 'Departures not found'], 404);
        }
        return response()->json($departures);
    }

    // Create a new departures (POST /departures)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'address' => 'required|string|max:255',
            'paragraph' => 'nullable',
        ]);

        // Create a new departures using the validated data
        $departures = Departures::create($validatedData);

        // Check if the departures was successfully created
        if ($departures) {
            return response()->json(['success' => 'Departures created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create Departures'], 500);
        }
    }

    // Update an existing departures (PUT /departures/{id})
    public function update(Request $request, $id)
    {
        // Find the departures by id or fail
        $departures = Departures::find($id);
        if (!$departures) {
            return response()->json(['message' => 'Departures not found'], 404);
        }
        // Log the current departures data
        $updatedData = $request->merge(json_decode($request->getContent(), true));

        // Create an array with the updated data from the request
        $updatedData = [
            'name' => $request->name,
            'date' => $request->date,
            'address' => $request->address,
            'paragraph' => $request->paragraph,
        ];

        // Attempt to update the departures with the new data
        if (!$departures->update($updatedData)) {
            return response()->json(['message' => 'Failed to update Departures'], 500);
        }

        return response()->json(['success' => 'Departures updated successfully'], 200);
    }


    // Delete a departures (DELETE /departures/{id})
    public function destroy($id)
    {

        $departures = Departures::find($id);

        if (!$departures) {
            return response()->json(['message' => 'Departures not found'], 404);
        }

        $departures->delete();

        return response()->json(['message' => 'Departures deleted successfully']);
    }
}
