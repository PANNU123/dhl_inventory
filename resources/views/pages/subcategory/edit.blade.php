@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Add Category'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Category</h3>
            </div>
            <form method="post" action="{{route('backend.sub.category.update')}}">
                @csrf
                <input type="hidden" name="id" value="{{$edit->id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label>Category Name</label>
                            <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$edit->category->id == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="name" value="{{$edit->name}}" class="form-control" placeholder="Category Name">
                        </div>
                    </div>
                </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('post_scripts')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
  </script>
  @endpush