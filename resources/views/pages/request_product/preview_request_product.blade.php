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
                        <form method="post" action="{{route('backend.request.product.preview.store')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="col-12">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Product Name</label>
                                            <input type="text" name="name" value="{{ $data->product->name}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Product Quantity</label>
                                            <input type="text" name="product_quantity" value="{{ $data->product->qty}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                        <div class="col-4">
                                            <label>Request Product Quantity</label>
                                            <input type="text" name="request_quantity" value="{{ $data->quantity}}" class="form-control" placeholder="quantity" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Product Name</label>
                                            <select class="form-select" id="checkQuantity" disabled>
                                                <option {{$data->admin_set_quantity == ISSUE_FULL_QUANTITY ? "selected" : ""}}>Issue Full Quantity</option>
                                                <option {{$data->admin_set_quantity == ISSUE_PARTIAL_QUANTITY ? "selected" : ""}}>Issue Partial Quantity</option>
                                                <option {{$data->admin_set_quantity == ISSUE_BALANCE_QUANTITY ? "selected" : ""}}>Issue Balance Quantity</option>
                                            </select>
                                            @if($data->admin_set_quantity == ISSUE_FULL_QUANTITY)
                                            <input type="hidden" name="check_quantity" value="IFQ">
                                            @elseif($data->admin_set_quantity == ISSUE_PARTIAL_QUANTITY)
                                            <input type="hidden" name="check_quantity" value="IPQ">
                                            @elseif($data->admin_set_quantity == ISSUE_BALANCE_QUANTITY)
                                            <input type="hidden" name="check_quantity" value="IBQ">
                                            @endif
                                        </div>
                                        @if($data->admin_set_quantity == ISSUE_PARTIAL_QUANTITY)
                                            <div class="col-4 partialQuantityShow">
                                                <label>Product Name</label>
                                                <input type="text" name="partial_quantity" class="form-control" placeholder="quantity">
                                            </div>
                                        @endif
                                        <div class="col-4">
                                            <label>Vehicle</label>
                                            <select class="form-select" name="vehicle_id" id="">
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}">{{ $vehicle->vehicle_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-danger">Submit</button>
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
