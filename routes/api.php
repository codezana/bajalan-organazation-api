<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\AccountingController;
use App\Http\Controllers\API\DecisionsController;
use App\Http\Controllers\API\DeparturesController;
use App\Http\Controllers\API\EquipmentsController;
use App\Http\Controllers\API\MembersController;
use App\Http\Controllers\API\Trashed\AccountingController as Accounting;
use App\Http\Controllers\API\Trashed\DeparturesController as Departures;
use App\Http\Controllers\API\Trashed\DecisionsController as Decisions;
use App\Http\Controllers\API\Trashed\EquipmentsController as Equipments;
use App\Http\Controllers\API\Trashed\MembersController as Members;

Route::middleware('json')->group(function () {

    //Home page
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);

    //Accounting
    Route::apiResource('/accounting', AccountingController::class);

    //Decisions
    Route::apiResource('/decisions', DecisionsController::class);

    //Departures
    Route::apiResource('/departures', DeparturesController::class);

    //Equipments
    Route::apiResource('/equipments', EquipmentsController::class);

    //Members
    Route::apiResource('/members', MembersController::class);


    // Trashed Folder
    Route::apiResource('/trashed/accounting', Accounting::class)->names('trashed.accounting');
    Route::apiResource('/trashed/departures', Departures::class)->names('trashed.departures');
    Route::apiResource('/trashed/decisions', Decisions::class)->names('trashed.decisions');
    Route::apiResource('/trashed/equipments', Equipments::class)->names('trashed.equipments');
    Route::apiResource('/trashed/members', Members::class)->names('trashed.members');
});
