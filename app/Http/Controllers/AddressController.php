<?php

namespace App\Http\Controllers;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    { 
        $_code = '_code';
        $_name_en = '_name_kh';
        if(session()->get('locale') == 'kh'){
            return Address::where($_code,'Like',$request->code."__")
            ->orderBy($_name_en)
            ->pluck($_code,'_name_kh');  
        }else{
            return Address::where($_code,'Like',$request->code."__")
            ->orderBy($_name_en)
            ->pluck($_code,$_name_en);     
        }
    }
}
