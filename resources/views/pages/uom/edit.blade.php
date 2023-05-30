@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Edit UOM'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit UOM</h3>
            </div>
            <form method="post" action="{{route('backend.uom.update')}}">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$edit->id}}">
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
