<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RouteController extends Controller
{
        public function route(Request $request){

        if ($request->ajax()) {
            $data = Route::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.route.edit',$data->id).'" class="btn btn-primary btn-sm">Edit</a>';
                    $btn =$btn.'<a href="'.route('backend.route.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.route.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Inactive</a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.route.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Active</a>';
                    }
                    return $btn;
                })
                ->editColumn('Name', function ($data) {
                    return $data->name;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="eg-btn green-light--btn">Active</span>';
                    }else{
                        return '<span class="eg-btn red-light--btn">InActive</span>';
                    }
                })
                ->rawColumns(['action','Name','Status'])
                ->make(true);
        }
        return view('pages.route.index');
    }
    public function routeCreate(){
        return view('pages.route.add');
    }
    public function routeStore(Request $request){
        Route::create([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.route');
    }
    public function routeEdit($id){
        $edit = Route::where('id',$id)->first();
        return view('pages.route.edit',compact('edit'));
    }
    public function routeUpdate(Request $request){
        Route::where('id',$request->id)->update([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.route');
    }

    public function routeDelete($id){
        Route::where('id',$id)->delete();
        return redirect()->back();
    }
    public function routeActive($id){
        Route::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect()->back();
    }
    public function routeInactive($id){
        Route::where('id',$id)->update([
            'status'=>0
        ]);
        return redirect()->back();
    }
    public function slugify($text){
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate divider
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
