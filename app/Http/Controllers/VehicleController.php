<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VehicleController extends Controller
{
    public function vehicle(Request $request)
    {
        if ($request->ajax()) {
            $data = Vehicle::with('user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<a href="'.route('backend.vehicle.edit',$data->id).'" class="btn btn-primary btn-sm">Edit</a>';
                    $btn =$btn.'<a href="'.route('backend.vehicle.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
                    if($data->status == 1){
                        $btn =$btn.'<a href="'.route('backend.vehicle.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Inactive</a>';
                    }else{
                        $btn =$btn.'<a href="'.route('backend.vehicle.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Active</a>';
                    }
                    return $btn;
                })
                ->editColumn('Name', function ($data) {
                    return $data->user->full_name;
                })
                ->editColumn('Vehicle_Name', function ($data) {
                    return $data->vehicle_name;
                })
                ->editColumn('Vehicle_CC', function ($data) {
                    return $data->vehicle_cc;
                })
                ->editColumn('Vehicle_Engine_Number', function ($data) {
                    return $data->vehicle_engine_number;
                })
    //                ->editColumn('Vendors_Address', function ($data) {
    //                    return $data->vendor_address;
    //                })
                ->editColumn('Vehicle_Chassis_Number', function ($data) {
                    return $data->vehicle_chassis_number;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="eg-btn green-light--btn">Active</span>';
                    }else{
                        return '<span class="eg-btn red-light--btn">InActive</span>';
                    }
                })
                ->rawColumns(['action','Vehicle_Name','Vehicle_CC','Vehicle_Engine_Number','Vehicle_Chassis_Number','Status'])
                ->make(true);
        }
        return view('pages.vehicle.index');
    }
    public function vehicleCreate(){
        $users = User::get();
        return view('pages.vehicle.add',compact('users'));
    }
    public function vehicleStore(Request $request){
//        return $request->all();
        Vehicle::create([
            'user_id'=>$request->user_id,
            'vehicle_name'=>$request->vehicle_name,
            'vehicle_cc'=>$request->vehicle_cc,
            'vehicle_engine_number'=>$request->vehicle_engine_number,
            'vehicle_chassis_number'=>$request->vehicle_chassis_number,
        ]);
        return redirect()->route('backend.vehicle');
    }
    public function vehicleEdit($id){
        $users = User::get();
        $edit = Vehicle::with('user')->where('id',$id)->first();
        return view('pages.vehicle.edit',compact('edit','users'));
    }
    public function vehicleUpdate(Request $request){
        Vehicle::where('id',$request->id)->update([
            'user_id'=>$request->user_id,
            'vehicle_name'=>$request->vehicle_name,
            'vehicle_cc'=>$request->vehicle_cc,
            'vehicle_engine_number'=>$request->vehicle_engine_number,
            'vehicle_chassis_number'=>$request->vehicle_chassis_number,
        ]);
        return redirect()->route('backend.vehicle');
    }
    public function vehicleDelete($id){
        Vehicle::where('id',$id)->delete();
        return redirect()->back();
    }
    public function vehicleActive($id){
        Vehicle::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect()->back();
    }
    public function vehicleInactive($id){
        Vehicle::where('id',$id)->update([
            'status'=>0
        ]);
        return redirect()->back();
    }
}
