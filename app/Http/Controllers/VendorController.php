<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function vendor(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.vendor.edit',$data->id).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn =$btn.'<a href="'.route('backend.vendor.delete',$data->id).'" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash"></i></a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.vendor.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2"><i style="color: white" class="fas fa-arrow-down"></i></a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.vendor.status.active',$data->id).'" class="btn btn-success btn-sm ml-2"><i style="color: white" class="fas fa-arrow-up"></i></a>';
                    }
                    return $btn;
                })
                ->editColumn('SAP_Vendor_Code', function ($data) {
                    return $data->sap_vendor_code;
                })
                ->editColumn('Get_Vendor_Code', function ($data) {
                    return $data->get_vendor_code;
                })
                ->editColumn('Vendors_Name', function ($data) {
                    return $data->vendor_name;
                })
//                ->editColumn('Vendors_Address', function ($data) {
//                    return $data->vendor_address;
//                })
                ->editColumn('Contact_Persons_Name', function ($data) {
                    return $data->contact_person_name;
                })
                ->editColumn('Contact_Number', function ($data) {
                    return $data->contact_number;
                })
//                ->editColumn('Contact_Email', function ($data) {
//                    return $data->contact_email;
//                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="badge bg-success">Active</span>';
                    }else{
                        return '<span class="badge bg-warning">InActive</span>';
                    }
                })
                ->rawColumns(['action','SAP_Vendor_Code','get_vendor_code','vendor_name','vendor_address','contact_person_name','contact_number','contact_email','Status'])
                ->make(true);
        }
        return view('pages.vendor.index');
    }
    public function vendorCreate()
    {
        return view('pages.vendor.add');
    }
    public function vendorStore(Request $request)
    {
        Vendor::create([
            'sap_vendor_code' => $request->sap_vendor_code,
            'get_vendor_code' => $request->get_vendor_code,
            'vendor_name' =>  $request->vendor_name,
            'vendor_address'=> $request->vendor_address,
            'contact_person_name'=> $request->contact_person_name,
            'contact_number'=> $request->contact_number,
            'contact_email'=> $request->contact_email,
        ]);
        Toastr::success('', 'Vendor Added Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.vendor');
    }
    public function vendorEdit($id){
        $edit = Vendor::where('id',$id)->first();
        return view('pages.vendor.edit',compact('edit'));
    }
    public function vendorUpdate(Request $request){
        Vendor::where('id',$request->id)->update([
            'sap_vendor_code' => $request->sap_vendor_code,
            'get_vendor_code' => $request->get_vendor_code,
            'vendor_name' =>  $request->vendor_name,
            'vendor_address'=> $request->vendor_address,
            'contact_person_name'=> $request->contact_person_name,
            'contact_number'=> $request->contact_number,
            'contact_email'=> $request->contact_email,
        ]);
        Toastr::success('', 'Vendor Update Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->route('backend.vendor');
    }
    public function vendorDelete($id){
        Vendor::where('id',$id)->delete();
        Toastr::error('', 'Vendor Delete Successfully', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function vendorActive($id){
        Vendor::where('id',$id)->update([
            'status'=>1
        ]);
        Toastr::success('', 'Vendor Status Active', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function vendorInactive($id){
        Vendor::where('id',$id)->update([
            'status'=>0
        ]);
        Toastr::warning('', 'Vendor Status InActive', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
