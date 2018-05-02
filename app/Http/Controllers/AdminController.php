<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\User;
use App\Category;
use App\Movie;
use App\Link;
use App\Info;
use App\Nation;
use \Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function getLogin(){
        if(!Auth::check()){
            return view('admin.login');
        } else{
            return redirect()->route('admin');
        }
        
    }
    public function postLogin(LoginRequest $request){
        if (Auth::attempt(['email' => $request->txtEmail, 'password' => $request->txtPass])) {
            // Authentication passed...
            return redirect()->route('admin');
        }else{
            return redirect()->back()->withInput($request->except('password'))->withErrors(['field_name' => ['Tài khoản hoặc mật khẩu bạn nhập không đúng']]);
        }
    }
    public function getLogout(){
        Auth::logout();
        Cache::flush();
        return redirect()->route('getLogin');
    }

    public function getListCate(){
        $cate = new Category();
        return response()->json($cate -> get(),200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function AddCate(Request $request){
        $cate = new Category();
        $cate->name = $request ->name;
        $cate->type = $request ->type;
        $cate->save();
    }
    public function getEdit($id){
        return Category::findOrFail($id);
    }
    public function getType($type){
        $movieintype = DB::table('category')
        ->where('type',$type)
        ->get();
        return response()->json($movieintype,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }
    public function postEdit(Request $request,$id){
        $cate = Category::findOrFail($id);
        $cate->name = $request ->name;
        $cate->type = $request ->type;
        $cate->updated_at = Carbon::now();
        $cate->save();

        return('Update success');
    }

    public function getDelete($id){
        $cate = Category::findOrFail($id);
        $cate->delete();
    }

    public function getListMovie(){
        $movie = DB::table('category')
            ->join('movie','category.id','=','movie.id_category')
            ->join('nation','nation.id','=','movie.id_nation')
            ->select('movie.name as movie_name','movie.status','category.name','category.type','movie.id','nation.id as nation_id','nation.name as nation_name')
            ->get();
        return response()->json($movie,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function AddMovie(Request $req){
        $movie = new Movie();
        $movie -> name = $req -> name;
        $movie -> id_nation = $req -> nation;
        $movie -> status = $req -> status;
        $movie -> id_category = $req -> type;
        $movie -> save();    
    }

    public function getMovieEdit($id){
        $movie = DB::table('movie')
        ->where('movie.id','=',$id)
        ->join('category','movie.id_category','=','category.id')
        ->select('category.type as theloai', 'movie.name','movie.id as id_movie', 'movie.id_category as category_id', 'movie.id_nation as nation_id', 'movie.status as chatluong')
        ->get();
        return response()->json($movie,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function postMovieEdit(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->name = $request ->name;
        $movie->status = $request ->chatluong;
        $movie->id_category = $request ->type;
        $movie->id_nation = $request ->nation;
        $movie->updated_at = Carbon::now();
        $movie->save();

        return('Update success');
    }

    public function getMovieDelete($id){
        $movie = Movie::findorFail($id);
        $movie -> delete();
    }

    public function getLinkPhimLe($id){
        //Phần comment là lấy tất cả phim lẻ chưa có link
        // $phimle = DB::table('category')->select('id')->where('type', '1')->get();
        // $data = json_decode($phimle, TRUE);
        $movie = DB::table('movie')
            // ->whereIn('id_category',$data)
            ->where('id_category',$id)
            ->whereNotExists(function($query){
                $query->select(DB::raw(1))
                      ->from('link')
                      ->whereRaw('movie.id=link.id_movie');
            })->get();
        
        return response()->json($movie,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function getLinkPhimBo($id){
        $movie = DB::table('movie')
                ->where('id_category',$id)
                ->get();
        return response()->json($movie,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function getListLink(){
        $link = DB::table('movie')
            ->join('link','movie.id','=','link.id_movie')
            ->select('movie.name','link.id','link.link','link.chapter')
            ->get();
        return response()->json($link,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function getLinkEdit($id){
        $link = DB::table('movie')
            ->join('link','movie.id','=','link.id_movie')
            ->select('movie.name','link.id','link.link','link.chapter')
            ->where('link.id','=',$id)
            ->get();
        return response()->json($link,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function postLinkEdit(Request $request, $id){
        $link = Link::findOrFail($id);
        $link->link = $request ->link;
        $link->chapter = $request ->chapter;
        $link->updated_at = Carbon::now();
        $link->save();

    }

    public function getLinkDelete($id){
        $link = Link::findOrFail($id);
        $link -> delete();
    }
    public function AddLink(Request $req){
        $link = new Link();
        $link->id_movie = $req->id_movie;
        $link->link = $req->link;
        $link->chapter = $req->chapter;
        $link->save();
    }

    public function getMovieNotExists(){
        $movie = DB::table('movie')
            ->whereNotExists(function($query){
                $query->select(DB::raw(1))
                      ->from('info')
                      ->whereRaw('movie.id=info.id_movie');
            })->get();
        
        return response()->json($movie,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function AddInfo(Request $r){

        // $info = new Info();
        // $info->id_movie = $req->id_movie;
        // $info->daodien = $req->daodien;
        // $info->dienvien = $req->dienvien;
        // $info->dodai = $req->dodai;
        // $info->gioithieu = $req->gioithieu;
        // $info-> save();
        if (Input::hasFile('file'))
        {
            // // get image name
            $image=Input::file('file')->getClientOriginalName();
            // // move file to uploads
            $file=Input::file('file');
            $file->move(__DIR__ . '/../../../public/images/' , $file->getClientOriginalName());

            // // save data to database
            $info = new Info();
            $info->id_movie = $r->info['id_movie'];
            $info->daodien = $r->info['daodien'];
            $info->poster = $image;
            $info->dienvien = $r->info['dienvien'];
            $info->dodai = $r->info['dodai'];
            $info->gioithieu = $r->info['gioithieu'];
            $info-> save();
            return "Insert Thành Công";
            // return "file present"."  ".$r->username." ".$image_name;
        }
        else{
            return "file not present";
        }
    }
    

    public function getInfoList(){
        $info = DB::table('movie')
            ->join('info', 'movie.id','=','info.id_movie')
            ->select('movie.id','movie.name','info.id as info_id','info.daodien','info.dienvien','info.dodai','info.gioithieu','info.poster')
            ->get();
        return response()->json($info,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function getInfoEdit($id){
        $info = DB::table('movie')
            ->join('info', 'movie.id', '=','info.id_movie')
            ->select('movie.id','movie.name','info.id as info_id','info.daodien','info.dienvien','info.dodai','info.gioithieu')
            ->where('info.id','=',$id)
            ->get();
        return response()->json($info,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function postInfoEdit(Request $req, $id){
        $image=Input::file('file')->getClientOriginalName();
        $file=Input::file('file');
        $file->move(__DIR__ . '/../../../public/images/' , $file->getClientOriginalName());
        
        $info = Info::findOrFail($id);
        $info->daodien = $req->info['daodien'];
        $info->dienvien = $req->info['dienvien'];
        $info->poster = $image;
        $info->dodai = $req->info['dodai'];
        $info->gioithieu = $req->info['gioithieu'];
        $info->updated_at = Carbon::now();
        $info->save();
    }

    public function getInfoDelete($id){
        $info = Info::findOrFail($id);
        $info->delete();
    }

    public function getUserList(){
        $user = new User();
        return response()->json($user->orderBy('level')-> get(),200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function AddUser(Request $req){
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->pass);
        $user->level = $req->type;
        $user->save();
    }

    public function getUserDelete($id){
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getListNation(){
        $nation = DB::table('nation')->get();
        return response()->json($nation,200,[],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    public function AddNation(Request $req){
        $nation = new Nation();
        $nation->name = $req->name;
        $nation->save();
    }

    public function getNationEdit($id){
        return Nation::findOrFail($id);
    }

    public function postNationEdit(Request $req, $id){
        $nation = Nation::findOrFail($id);
        $nation->name = $req->name;
        $nation->save();
    }

    public function getNationDelete($id){
        $nation = Nation::findOrFail($id);
        $nation->delete();
    }

}
