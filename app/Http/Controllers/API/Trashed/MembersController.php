<?php

namespace App\Http\Controllers\API\Trashed;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
   
    // get all trashed records (GET /trashed/members)
    public function index()
    {
        $membersTrash = Members::onlyTrashed()->get();
        return response()->json($membersTrash);
    }

    // Get details of a specific trashed members) (GET /trashed/members)/{id})
    public function show($id)
    {

        $membersTrashId= Members::onlyTrashed()->find($id);

        if (!$membersTrashId) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        return response()->json($membersTrashId);
    }

    // Restore a trashed record by ID (PUT /trashed/members)/{id})
    public function update($id)
    {

        $membersTrashUpdate = Members::onlyTrashed()->find($id);

        if (!$membersTrashUpdate) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $membersTrashUpdate->restore();

        return response()->json(['message' => 'Record restored successfully']);
    }

    // Permanently delete a trashed record by ID (DELETE /trashed/members)/{id})
    public function destroy($id)
    {

        $membersTrashDelete = members::onlyTrashed()->find($id);

        if (!$membersTrashDelete) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $membersTrashDelete->forceDelete();

        return response()->json(['message' => 'Record permanently deleted']);
    }
}
