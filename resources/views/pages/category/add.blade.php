@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Add Category'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
          <!-- general form elements -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Category</h3>
            </div>
            <form method="post" action="{{route('backend.category.store')}}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="name" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="col-6">
                            <select name="roles[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                @foreach($users as $item)
                                    <option value="{{$item->id}}">{{$item->full_name}}</option>
                                @endforeach
                            </select>
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
