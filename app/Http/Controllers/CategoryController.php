<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class CategoryController extends Controller
{
    public function category(Request $request){

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.category.edit',$data->id).'" class="btn btn-primary btn-sm">Edit</a>';
                    $btn =$btn.'<a href="'.route('backend.category.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.category.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Inactive</a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.category.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Active</a>';
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
        return view('pages.category.index');
    }
    public function categoryCreate(){
        return view('pages.category.add');
    }
    public function categoryStore(Request $request){
        Category::create([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.category');
    }
    public function categoryEdit($id){
        $edit = Category::where('id',$id)->first();
        return view('pages.category.edit',compact('edit'));
    }
    public function categoryUpdate(Request $request){
        $update = Category::where('id',$request->id)->update([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.category');
    }

    public function categoryDelete($id){
        $delete = Category::where('id',$id)->delete();
        return redirect()->back();
    }
    public function categoryActive($id){
        Category::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect()->back();
    }
    public function categoryInactive($id){
        Category::where('id',$id)->update([
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
