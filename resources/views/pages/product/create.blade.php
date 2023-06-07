@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Add Category'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Category</h3>
            </div>
            <form method="post" action="{{route('backend.product.store')}}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <label>Vendor Name</label>
                            <select class="form-select" name="vendor_id">
                                @foreach ($vendors as $item)
                                    <option value="{{$item->id}}">{{$item->vendor_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Category Name</label>
                            <select class="form-select" name="category_id">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Sub Category Name</label>
                            <select class="form-select" name="sub_category_id">
                                @foreach ($subcategories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>UOM</label>
                            <select class="form-select" name="uom_id">
                                @foreach ($uoms as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <input type="text" name="name" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="col-4">
                            <input type="number" name="price" class="form-control" placeholder="Price">
                        </div>
                        <div class="col-4">
                            <input type="number" name="qty" class="form-control" placeholder="Quantity">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
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
