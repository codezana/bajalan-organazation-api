<?php

namespace App\Http\Controllers\API\Trashed;

use App\Http\Controllers\Controller;
use App\Models\Decisions;
use Illuminate\Http\Request;

class DecisionsController extends Controller
{
    
    // get all trashed records (GET /trashed/decisions)
    public function index()
    {
        $decisionsTrash = Decisions::onlyTrashed()->get();
        return response()->json($decisionsTrash);
    }

    // Get details of a specific trashed decisions) (GET /trashed/decisions)/{id})
    public function show($id)
    {

        $decisionsTrashId= Decisions::onlyTrashed()->find($id);

        if (!$decisionsTrashId) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        return response()->json($decisionsTrashId);
    }

    // Restore a trashed record by ID (PUT /trashed/decisions)/{id})
    public function update($id)
    {

        $decisionsTrashUpdate = Decisions::onlyTrashed()->find($id);

        if (!$decisionsTrashUpdate) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $decisionsTrashUpdate->restore();

        return response()->json(['message' => 'Record restored successfully']);
    }

    // Permanently delete a trashed record by ID (DELETE /trashed/decisions)/{id})
    public function destroy($id)
    {

        $decisionsTrashDelete = Decisions::onlyTrashed()->find($id);

        if (!$decisionsTrashDelete) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $decisionsTrashDelete->forceDelete();

        return response()->json(['message' => 'Record permanently deleted']);
    }
}
