<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function getListCategoryPhimLe(){
        $cate = DB::table('category')
        ->where('type','=',1)
        ->get();
        return response()->json($cate,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function getListCategoryPhimBo(){
        $cate = DB::table('category')
        ->where('type','=',2)
        ->get();
        return response()->json($cate,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
}
