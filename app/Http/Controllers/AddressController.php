<?php

namespace App\Http\Controllers;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    { 
        $object = [];
        $query = (new Address)->newQuery();
        $query->select('_code','_name_en','_name_kh');
        $query->where('_code','Like',$request->code."__")->orderBy('_name_en');
        foreach($query->get() as $vlaue): 
            if(!empty($request->lang)): 
                if(strtolower($request->lang) == 'en'): 
                    $tmp = ['code' => $vlaue->_code, 'name' => $vlaue->_name_en];
                else: 
                    $tmp = ['code' => $vlaue->_code,'name' => $vlaue->_name_kh];
                endif;
            else: 
                $tmp = ['code' => $vlaue->_code,'name' => $vlaue->_name_en];
            endif;
            array_push($object, $tmp);
        endforeach;
        return response()->json($object);
    }
}
