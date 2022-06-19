<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Response;
use Auth;
use Session;

/* included models */
use App\Models\Designation;

class DynamicDependentController extends Controller
{
    public function getDesignationsByLevel(Request $request){

        $data = $request->all();

        $designations = Designation::where('level_id', $data['level_id'])
                                    ->select('id', 'name')
                                    ->get();

        return Response::json($designations);
    }
}