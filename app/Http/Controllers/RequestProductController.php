<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequestProduct;
use App\Models\Route;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
                        return '<span class="eg-btn green-light--btn">Active</span>';
                    }else{
                        return '<span class="eg-btn red-light--btn">InActive</span>';
                    }
                })
                ->rawColumns(['action','Product_Name','Route_Name','Quantity','Status'])
                ->make(true);
        }
        return view('pages.request_product.index');
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
                        return '<span class="eg-btn green-light--btn">Active</span>';
                    }else{
                        return '<span class="eg-btn red-light--btn">InActive</span>';
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
        return view('pages.request_product.preview_request_product',compact('data'));
    }
    public function requestProductPreview(Request $request)
    {
        $request_product = RequestProduct::where('id',$request->id)->first();
        if($request->check_quantity == 'IFQ'){
            RequestProduct::where('id',$request->id)->update([
                'issue_full_quantity'=>$request->request_quantity,
            ]);
            $product = Product::where('id',$request->id)->first();
            if($product){
                $product->update([
                   'qty'=>$product->qty - $request->request_quantity
                ]);
            }
            return redirect()->back();
        }
        if($request->check_quantity == 'IPQ'){
            RequestProduct::where('id',$request->id)->update([
                'issue_partial_quantity' => $request->partial_quantity,
                'issue_balance_quantity' =>  $request->request_quantity - $request->partial_quantity
            ]);
            $product = Product::where('id',$request_product->product_id)->first();
//            if ($request_product)
//            {
//                $request->update([
//                    'quantity' => $request_product->quantity - $request->partial_quantity
//                ]);
//            }
            if($product && $request_product){
                $request_product->update([
                    'quantity' => $request_product->quantity - $request->partial_quantity
                ]);
                $product->update([
                    'qty'=>$product->qty - $request->partial_quantity
                ]);
            }
            return redirect()->back();
        }
        if($request->check_quantity == 'IBQ'){
            RequestProduct::where('id',$request->id)->update([
                'issue_balance_quantity' =>  $request->request_quantity
            ]);
            return redirect()->back();
        }
    }
}
