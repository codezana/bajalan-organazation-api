<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Cards};
class HomeController extends Controller
{
 
   
    public function index()
    {
        $Cards = Cards::all();

        return response()->json([
            'data' => $Cards
        ]);
    }


}
