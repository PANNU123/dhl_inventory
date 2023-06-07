@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Add Route'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
          <!-- general form elements -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Quick Example</h3>
            </div>
            <form method="post" action="{{route('backend.route.update')}}">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$edit->id}}">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="name" value="{{$edit->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="code" value="{{$edit->code}}" class="form-control">
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
