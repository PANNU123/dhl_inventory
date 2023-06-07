<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\Route;
use App\Models\Vehicle;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class RequestProductController extends Controller
{
    public function requestProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = RequestProduct::with('product','route')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if($data->status == 0) {
                        $btn = '<a href="' . route('backend.request.product.status.active', $data->id) . '" class="btn btn-primary btn-sm">View</a>';
                    }elseif($data->status == 1){
                        $btn = '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Rejected</a>';
                    }
                    else{
                        $btn = '<a href="javascript:void(0)" class="btn btn-success btn-sm">Approved</a>';
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
                    if($data->status == PENDING_PRODUCT){
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                    if($data->status == REJECTED_PRODUCT){
                        return '<span class="badge bg-danger">Rejected</span>';
                    }
                    if ($data->status == APPROVED_PRODUCT)
                    {
                        return '<span class="badge bg-success">Approved</span>';
                    }
                    if ($data->status == ON_THE_WAY)
                    {
                        return '<span class="badge bg-success">On the Way</span>';
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
            $data = RequestProduct::with('product','route')->where('user_id',Auth::id())->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if($data->status == ON_THE_WAY){
                        $btn = '<a href="' . route('backend.request.product.status.active', $data->id) . '" class="btn btn-success btn-sm">Received</a>';
                    }else{
                        $btn = '<a href="javascript:void(0)" class="btn btn-dark btn-sm" disabled>-</a>';
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
                    if($data->status == PENDING_PRODUCT){
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                    if($data->status == REJECTED_PRODUCT){
                        return '<span class="badge bg-danger">Rejected</span>';
                    }
                    if ($data->status == APPROVED_PRODUCT)
                    {
                        return '<span class="badge bg-success">Approved</span>';
                    }
                    if ($data->status == ON_THE_WAY)
                    {
                        return '<span class="badge bg-success">On the Way</span>';
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
            $data = RequestProduct::with('product','route')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->status == APPROVED_PRODUCT){
                        $btn = '<a href="' . route('backend.request.product.qty.check', $data->id) . '" class="btn btn-success btn-sm">View</a>';
                    }
                    elseif($data->status == PENDING_PRODUCT){
                        $btn = '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Not Approved</a>';
                    }
                    elseif($data->status == REJECTED_PRODUCT){
                        $btn = '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Not Approved</a>';
                    }
                    else{
                        $btn = '<a href="javascript:void(0)" class="btn btn-dark btn-sm">-</a>';
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
                    if($data->status == APPROVED_PRODUCT){
                        return '<span class="badge bg-success">Approved</span>';
                    }elseif($data->status == REJECTED_PRODUCT){
                        return '<span class="badge bg-danger">Rejected</span>';
                    }elseif($data->status == ON_THE_WAY){
                        return '<span class="badge bg-warning">On the Way</span>';
                    }elseif($data->status == PENDING_PRODUCT){
                        return '<span class="badge bg-danger">Not Approved</span>';
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
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('backend.request.product.create');
    }

    public function requestProductActive($id){
        $data = RequestProduct::with('product','route','user')->where('id',$id)->first();
        $vehicles = Vehicle::get();
        $category_wise_user =  DB::table('categories_wise_user')->where('category_id',$data->product->category_id)->where('user_id',Auth::id())->first();
        if($category_wise_user){
            return view('pages.request_product.approved_request_product',compact('data','vehicles'));
        }else{
            Toastr::error('', 'You have no permissions this product category', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
    public function requestProductApprovedOrRejected(Request $request){
        $update = RequestProduct::where('id',$request->id)->update([
            'admin_set_quantity'=>$request->admin_set_quantity,
            'status'=>APPROVED_PRODUCT,
        ]);
        if($update){
            return redirect()->route('backend.request.product');
        }
    }
    public function requestProductRejected($id){
        $update = RequestProduct::where('id',$id)->update([
            'status'=>REJECTED_PRODUCT,
        ]);
        if($update){
            return redirect()->route('backend.request.product');
        }
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
                'status' => ON_THE_WAY,
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
                'status' => ON_THE_WAY,
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
                'status' => ON_THE_WAY,
            ]);
            return redirect()->back();
        }
    }
}
