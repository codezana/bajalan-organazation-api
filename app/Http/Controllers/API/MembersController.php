<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    // Get a list of all members (GET /members)
    public function index()
    {
        $members = Members::all();
        return response()->json($members);
    }
    // Get details of a specific member (GET /members/{id})
    public function show($id)
    {
        $member = Members::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        return response()->json($member);
    }

    // Create a new member (POST /members)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'work' => 'required|string|max:255',
            'join_date' => 'required|date',
        ]);
        // Create a new member using the validated data
        $member = Members::create($validatedData);

        // Check if the member was successfully created
        if ($member) {
            return response()->json(['success' => 'Member created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create member'], 500);
        }
    }

    // Update an existing member (PUT /members/{id})
    public function update(Request $request, $id)
    {
        // Find the member by id or fail
        $member = Members::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        // Log the current member data
        $updatedData = $request->merge(json_decode($request->getContent(), true));

        // Create an array with the updated data from the request
        $updatedData = [
            'name' => $request->name,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'education' => $request->education,
            'work' => $request->work,
            'join_date' => $request->join_date,
        ];

        // Attempt to update the member with the new data
        if (!$member->update($updatedData)) {
            return response()->json(['message' => 'Failed to update member'], 500);
        }

        return response()->json(['success' => 'Member updated successfully'], 200);
    }


    // Delete a member (DELETE /members/{id})
    public function destroy($id)
    {

        $member = Members::find($id);

        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();

        return response()->json(['message' => 'Member deleted successfully']);
    }
}
