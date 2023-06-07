@extends('master')
@section('content')
    @include('includes.breadcrumb',['breadcrumb' => 'Preview Request Product'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-10 offset-1">
                    <!-- general form elements -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Preview Request Product</h3>
                        </div>
                        <form method="post" action="{{route('backend.request.product.approved.or.rejected')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="col-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Requester Name</label>
                                            <input type="text" value="{{ $data->user->full_name}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Route Name</label>
                                            <input type="text" value="{{ $data->route->name}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Product Name</label>
                                            <input type="text" value="{{ $data->product->name}}" class="form-control" placeholder="quantity" readonly>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Product Stock Quantity</label>
                                            <input type="text" value="{{ $data->product->qty}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Request Product Quantity</label>
                                            <input type="text" value="{{ $data->quantity}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Issue Product Quantity</label>
                                            <select class="form-select" name="admin_set_quantity" id="checkQuantity">
                                                <option value="{{ISSUE_FULL_QUANTITY}}">Issue Full Quantity</option>
                                                <option value="{{ISSUE_PARTIAL_QUANTITY}}">Issue Partial Quantity</option>
                                                <option value="{{ISSUE_BALANCE_QUANTITY}}">Issue Balance Quantity</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('backend.request.product.rejected',['id'=>$data->id])}}" class="btn btn-danger">Rejected</a>
                                <button type="submit" class="btn btn-success float-right">Approved</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
{{--@push('post_scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).on('change','#checkQuantity',function (){--}}
{{--            let partial_check = $(this).val();--}}
{{--            if(partial_check === 'IPQ'){--}}
{{--                $('.partialQuantityShow').show();--}}
{{--            }else{--}}
{{--                $('.partialQuantityShow').hide();--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
