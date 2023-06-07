<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    public function subCategory(Request $request){
// return $data = SubCategory::with('category')->latest()->get();
        if ($request->ajax()) {
            $data = SubCategory::with('category')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.sub.category.edit',$data->id).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn =$btn.'<a href="'.route('backend.sub.category.delete',$data->id).'" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash"></i></a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.sub.category.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2"><i style="color: white" class="fas fa-arrow-down"></i></a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.sub.category.status.active',$data->id).'" class="btn btn-success btn-sm ml-2"><i style="color: white" class="fas fa-arrow-up"></i></a>';
                    }
                    return $btn;
                })

                ->editColumn('Sub_Category_Name', function ($data) {
                    return $data->name;
                })
                ->editColumn('Category_Name', function ($data) {
                    return $data->category->name;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="badge bg-success">Active</span>';
                    }else{
                        return '<span class="badge bg-warning">InActive</span>';
                    }
                })
                ->rawColumns(['action','Sub_Category_Name','Category_Name','Status'])
                ->make(true);
        }
        return view('pages.subcategory.index');
    }
    public function subCategoryCreate(){
        $categories = Category::get();
        return view('pages.subcategory.create',compact('categories'));
    }
    public function subCategoryStore(Request $request){
        SubCategory::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        Toastr::success('', 'SubCategory Added Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.sub.category');
    }
    public function subCategoryEdit($id){
        $categories = Category::get();
        $edit = SubCategory::with('category')->where('id',$id)->first();
        return view('pages.subcategory.edit',compact('edit','categories'));
    }
    public function subCategoryUpdate(Request $request){
        SubCategory::where('id',$request->id)->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        Toastr::success('', 'SubCategory Update Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.sub.category');
    }

    public function subCategoryDelete($id){
        SubCategory::where('id',$id)->delete();
        Toastr::error('', 'SubCategory Delete Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function subCategoryActive($id){
        SubCategory::where('id',$id)->update([
            'status'=>1
        ]);
        Toastr::success('', 'SubCategory Status Active', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function subCategoryInactive($id){
        SubCategory::where('id',$id)->update([
            'status'=>0
        ]);
        Toastr::warning('', 'SubCategory Status InActive', ["positionClass" => "toast-top-right"]);
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
