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
              <h3 class="card-title">Quick Example</h3>
            </div>
            <form method="post" action="{{route('backend.category.update')}}">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$edit->id}}">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="name" value="{{$edit->name}}" class="form-control" placeholder="Category Name">
                        </div>
                        <div class="col-6">
                            <select name="users[]" class="select2" multiple="multiple" data-placeholder="Select a user" style="width: 100%;">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ selectJobType($user->id, $edit->id) }}>{{$user->full_name}}</option>
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
