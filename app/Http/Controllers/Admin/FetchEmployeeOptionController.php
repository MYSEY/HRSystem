<?php

namespace App\Http\Controllers\admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchEmployeeOptionController extends Controller
{
    public function index(Request $request)
    {
        if($request->degree){
            return Option::select('id','name_khmer')->where('type', $request->degree)->get();
        }
        if($request->field_of_study){
            return Option::select('id','name_khmer')->where('type', $request->field_of_study)->get();
        }
    }
}
