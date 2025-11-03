<?php

namespace App\Http\Controllers\API\Trashed;

use App\Http\Controllers\Controller;
use App\Models\Departures;
use Illuminate\Http\Request;

class DeparturesController extends Controller
{
    
    // get all trashed records (GET /trashed/departures)
    public function index()
    {
        $departuresTrash = Departures::onlyTrashed()->get();
        return response()->json($departuresTrash);
    }

    // Get details of a specific trashed departures (GET /trashed/departures/{id})
    public function show($id)
    {

        $departuresTrashId= Departures::onlyTrashed()->find($id);

        if (!$departuresTrashId) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        return response()->json($departuresTrashId);
    }

    // Restore a trashed record by ID (PUT /trashed/departures/{id})
    public function update($id)
    {

        $departuresTrashUpdate = Departures::onlyTrashed()->find($id);

        if (!$departuresTrashUpdate) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $departuresTrashUpdate->restore();

        return response()->json(['message' => 'Record restored successfully']);
    }

    // Permanently delete a trashed record by ID (DELETE /trashed/departures/{id})
    public function destroy($id)
    {

        $departuresTrashDelete = Departures::onlyTrashed()->find($id);

        if (!$departuresTrashDelete) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $departuresTrashDelete->forceDelete();

        return response()->json(['message' => 'Record permanently deleted']);
    }
}
