<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class RequestProductController extends Controller
{
    public function requestProduct(Request $request)
    {
//        return $data = RequestProduct::with('product','route')->where('status',0)->latest()->get();
        if ($request->ajax()) {
            $data = RequestProduct::with('product','route')->where('status',0)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if($data->status == 0) {
                        $btn = '<a href="' . route('backend.request.product.status.active', $data->id) . '" class="btn btn-success btn-sm">Approved</a>';
                    }
//                    $btn =$btn.'<a href="'.route('backend.sub.category.delete',$data->id).'" class="btn btn-danger btn-sm ml-2">Delete</a>';
//                    if($data->status == 1){
//                        $btn ='<a href="'.route('backend.sub.category.status.inactive',$data->id).'"class="btn btn-warning btn-sm ml-2">Rejected</a>';
//                    }else{
//                        $btn ='<a href="'.route('backend.sub.category.status.active',$data->id).'" class="btn btn-success btn-sm ml-2">Approved</a>';
//                    }
                    return $btn;
                })

                ->editColumn('Product_Name', function ($data) {
                    return $data->product->name;
                })
                ->editColumn('Route_Name', function ($data) {
                    return $data->route->name;
                })
                ->editColumn('Quantity', function ($data) {
                    return $data->quantity;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="badge bg-success">Active</span>';
                    }else{
                        return '<span class="badge bg-warning">InActive</span>';
                    }
                })
                ->rawColumns(['action','Product_Name','Route_Name','Quantity','Status'])
                ->make(true);
        }
        return view('pages.request_product.index');
    }

    public function commercialRequestProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = RequestProduct::with('product','route')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if($data->status == 2) {
                        $btn = '<a href="' . route('backend.request.product.status.active', $data->id) . '" class="btn btn-success btn-sm">Received</a>';
                    }
                    return $btn;
                })

                ->editColumn('Product_Name', function ($data) {
                    return $data->product->name;
                })
                ->editColumn('Route_Name', function ($data) {
                    return $data->route->name;
                })
                ->editColumn('Quantity', function ($data) {
                    return $data->quantity;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 0){
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                    elseif ($data->status == 1)
                    {
                        return '<span class="badge bg-success">Approved</span>';
                    }
                    elseif($data->status == 2){
                        return '<span class="badge bg-success">On The Way</span>';
                    }
                })
                ->rawColumns(['action','Product_Name','Route_Name','Quantity','Status'])
                ->make(true);
        }
        return view('pages.request_product.commercial_index');
    }

    public function requestProductApproved(Request $request)
    {
//        return $data = RequestProduct::with('product','route')->where('status',0)->latest()->get();
        if ($request->ajax()) {
            $data = RequestProduct::with('product','route')->where('status',1)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->status == 1)
                    {
                        $btn = '<a href="' . route('backend.request.product.qty.check', $data->id) . '" class="btn btn-success btn-sm">View</a>';
                    }
                    return $btn;
                })
                ->editColumn('Product_Name', function ($data) {
                    return $data->product->name;
                })
                ->editColumn('Route_Name', function ($data) {
                    return $data->route->name;
                })
                ->editColumn('Quantity', function ($data) {
                    return $data->quantity;
                })
                ->editColumn('Status', function ($data) {
                    if($data->status == 1){
                        return '<span class="badge bg-success">Active</span>';
                    }else{
                        return '<span class="badge bg-warning">InActive</span>';
                    }
                })
                ->rawColumns(['action','Product_Name','Route_Name','Quantity','Status'])
                ->make(true);
        }
        return view('pages.request_product.approved_product');
    }

    public function requestProductCreate()
    {
        $products = Product::get();
        $routes = Route::get();
        return view('pages.request_product.add',compact('products','routes'));
    }

    public function requestProductStore(Request $request)
    {
        RequestProduct::create([
            'product_id' => $request->product_id,
            'route_id' => $request->route_id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('backend.request.product.create');
    }

    public function requestProductActive($id){
        RequestProduct::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect()->back();
    }
    public function requestProductQtyCheck($id)
    {
        $data = RequestProduct::with('product')->where('id',$id)->first();
        $vehicles = Vehicle::get();
        return view('pages.request_product.preview_request_product',compact('data','vehicles'));
    }
    public function requestProductPreview(Request $request)
    {
        $vehicle = Vehicle::where('id',$request->vehicle_id)->first();
        $user = User::where('id',$vehicle->user_id)->first();



        $request_product = RequestProduct::where('id',$request->id)->first();
        $product = Product::where('id',$request_product->product_id)->first();
        if($request->check_quantity == 'IFQ'){
            $request_product->update([
                'issue_full_quantity'=>$request->request_quantity,
                'quantity'=> 0,
                'status' => 2,
            ]);
            if($product){
                $product->update([
                    'qty'=>$product->qty - $request->request_quantity
                ]);
            }

            $data = [
                'name' =>$user->full_name,
                'subject' => 'Delivery Email',
                'message' => 'Delivery Message',
            ];
            $user_email =  $user->email;

            Mail::to($user_email)->send(new SendMail($data));
            return redirect()->back();
        }
        if($request->check_quantity == 'IPQ'){
            RequestProduct::where('id',$request->id)->update([
                'issue_partial_quantity' => $request->partial_quantity,
                'issue_balance_quantity' =>  $request->request_quantity - $request->partial_quantity,
                'status' => 2,
            ]);
            if($product && $request_product){
                $request_product->update([
                    'quantity' => $request_product->quantity - $request->partial_quantity
                ]);
                $product->update([
                    'qty'=>$product->qty - $request->partial_quantity
                ]);
            }
            $data = [
                'name' =>$user->full_name,
                'subject' => 'Delivery Email',
                'message' => 'Delivery Message',
            ];
            $user_email =  $user->email;

            Mail::to($user_email)->send(new SendMail($data));
            return redirect()->back();
        }
        if($request->check_quantity == 'IBQ'){
            RequestProduct::where('id',$request->id)->update([
                'quantity'=>0,
                'issue_balance_quantity' =>  $request->request_quantity,
                'status' => 2,
            ]);
            return redirect()->back();
        }
    }
}
