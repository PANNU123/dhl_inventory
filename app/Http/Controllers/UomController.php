<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Uom;

class UomController extends Controller
{
    public function uomIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Uom::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.uom.edit',$data->id).'" class="btn btn-primary btn-sm">Edit</a>';
                    $btn =$btn.'<a href="'.route('backend.uom.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.uom.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Inactive</a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.uom.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Active</a>';
                    }
                    return $btn;
                })
                ->editColumn('Name', function ($data) {
                    return $data->name;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="badge bg-success">Active</span>';
                    }else{
                        return '<span class="badge bg-warning">InActive</span>';
                    }
                })
                ->rawColumns(['action','Name','Status'])
                ->make(true);
        }
        return view('pages.uom.index');
    }
    public function uomCreate(){
        return view('pages.uom.add');
    }
    public function uomStore(Request $request){
        Uom::create([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        Toastr::success('', 'UOM Added Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.uom');
    }
    public function uomEdit($id){
        $edit = Uom::where('id',$id)->first();
        return view('pages.uom.edit',compact('edit'));
    }

    public function uomUpdate(Request $request){
        Uom::where('id',$request->id)->update([
            'name'=>$request->name,
            'slug'=>$this->slugify($request->name),
        ]);
        Toastr::success('', 'UOM Update Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.uom');
    }
    public function uomDelete($id){
        Uom::where('id',$id)->delete();
        Toastr::error('', 'UOM Delete Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function uomActive($id){
        Uom::where('id',$id)->update([
            'status'=>1
        ]);
        Toastr::success('', 'UOM Status Active', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function uomInactive($id){
        Uom::where('id',$id)->update([
            'status'=>0
        ]);
        Toastr::warning('', 'UOM Status InActive', ["positionClass" => "toast-top-right"]);
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
