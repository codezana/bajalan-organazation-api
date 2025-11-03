<?php

namespace App\Http\Controllers\API\Trashed;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use Illuminate\Http\Request;

class AccountingController extends Controller
{

    // get all trashed records (GET /trashed/accounting)
    public function index()
    {
        $accountingTrash = Accounting::onlyTrashed()->get();
        return response()->json($accountingTrash);
    }

    // Get details of a specific trashed accounting (GET /trashed/accounting/{id})
    public function show($id)
    {

        $accountingTrashId= Accounting::onlyTrashed()->find($id);

        if (!$accountingTrashId) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        return response()->json($accountingTrashId);
    }

    // Restore a trashed record by ID (PUT /trashed/accounting/{id})
    public function update($id)
    {

        $accountingTrashUpdate = Accounting::onlyTrashed()->find($id);

        if (!$accountingTrashUpdate) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $accountingTrashUpdate->restore();

        return response()->json(['message' => 'Record restored successfully']);
    }

    // Permanently delete a trashed record by ID (DELETE /trashed/accounting/{id})
    public function destroy($id)
    {

        $accountingTrashDelete = Accounting::onlyTrashed()->find($id);

        if (!$accountingTrashDelete) {
            return response()->json(['message' => 'Record trashed not found'], 404);
        }

        $accountingTrashDelete->forceDelete();

        return response()->json(['message' => 'Record permanently deleted']);
    }
}
