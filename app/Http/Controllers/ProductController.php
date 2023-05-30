<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Uom;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function product(Request $request){
        if ($request->ajax()) {
            $data = Product::with('category','subcategory','uom')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.product.edit',$data->id).'" class="btn btn-primary btn-sm">Edit</a>';
                    $btn =$btn.'<a href="'.route('backend.product.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.product.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Inactive</a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.product.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Active</a>';
                    }
                    return $btn;
                })
                ->editColumn('Product', function ($data) {
                    return $data->name;
                })
                ->editColumn('Price', function ($data) {
                    return $data->price;
                })
                ->editColumn('Qty', function ($data) {
                    return $data->qty;
                })
                ->editColumn('Category', function ($data) {
                    return $data->category->name;
                })
                ->editColumn('Sub_Category', function ($data) {
                    return $data->subcategory->name;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="eg-btn green-light--btn">Active</span>';
                    }else{
                        return '<span class="eg-btn red-light--btn">InActive</span>';
                    }
                })
                ->rawColumns(['action','Category','Sub_Category','Price','Qty','Status'])
                ->make(true);
        }
        return view('pages.product.index');
    }
    public function productCreate(){
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $uoms = Uom::get();
        return view('pages.product.create',compact('categories','subcategories','uoms'));
    }
    public function productStore(Request $request){
        Product::create([
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'uom_id'=>$request->uom_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'description'=>$request->description,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.product');
    }
    public function productEdit($id){
        $categories = Category::get();
        $subcategories = SubCategory::get();
        $uoms = Uom::get();
        $edit = Product::where('id',$id)->first();
        return view('pages.product.edit',compact('edit','categories','subcategories','uoms'));
    }
    public function productUpdate(Request $request){
        Product::where('id',$request->id)->update([
            'category_id'=>$request->category_id,
            'sub_category_id'=>$request->sub_category_id,
            'uom_id'=>$request->uom_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'description'=>$request->description,
            'slug'=>$this->slugify($request->name),
        ]);
        return redirect()->route('backend.product');
    }

    public function productDelete($id){
        Product::where('id',$id)->delete();
        return redirect()->back();
    }
    public function productActive($id){
        Product::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect()->back();
    }
    public function productInactive($id){
        Product::where('id',$id)->update([
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
