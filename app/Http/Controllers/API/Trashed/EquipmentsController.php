<?php

namespace App\Http\Controllers\API\Trashed;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentsController extends Controller
{
   
    // get all trashed records (GET /trashed/equipments)
    public function index()
    {
        $equipmentsTrash = Equipment::onlyTrashed()->get();
        return response()->json($equipmentsTrash);
    }

    // Get details of a specific trashed equipments (GET /trashed/equipments/{id})
    public function show($id)
    {

        $equipmentsTrashId= Equipment::onlyTrashed()->find($id);

        if (!$equipmentsTrashId) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        return response()->json($equipmentsTrashId);
    }

    // Restore a trashed record by ID (PUT /trashed/equipments/{id})
    public function update($id)
    {

        $equipmentsTrashUpdate = Equipment::onlyTrashed()->find($id);

        if (!$equipmentsTrashUpdate) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $equipmentsTrashUpdate->restore();

        return response()->json(['message' => 'Record restored successfully']);
    }

    // Permanently delete a trashed record by ID (DELETE /trashed/equipments/{id})
    public function destroy($id)
    {

        $equipmentsTrashDelete = Equipment::onlyTrashed()->find($id);

        if (!$equipmentsTrashDelete) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $equipmentsTrashDelete->forceDelete();

        return response()->json(['message' => 'Record permanently deleted']);
    }
}
