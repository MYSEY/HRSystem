<?php

namespace App\Http\Controllers\admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FetchExperienceController extends Controller
{
    public function index(Request $request)
    {
        if($request->employment_type){
            return Option::select('id','name_khmer')->where('type', $request->employment_type)->get();
        }
    }
}
