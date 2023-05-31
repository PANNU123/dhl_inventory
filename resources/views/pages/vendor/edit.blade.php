@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Edit Vendor'])

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8 offset-2">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Vendor</h3>
            </div>
            <form method="post" action="{{route('backend.vendor.update')}}">
                @csrf
                <input type="hidden" name="id" value="{{ $edit->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="sap_vendor_code" value="{{ $edit->sap_vendor_code }}" class="form-control" placeholder="SAP Vendor Code">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="get_vendor_code" value="{{ $edit->get_vendor_code }}" class="form-control" placeholder="Get Vendor Code">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="vendor_name" value="{{ $edit->vendor_name }}" class="form-control" placeholder="Vendor's Name">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="vendor_address" value="{{ $edit->vendor_address }}" class="form-control" placeholder="Vendor's Address">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="contact_person_name" value="{{ $edit->contact_person_name }}" class="form-control" placeholder="Contact Person's Name">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="contact_number" value="{{ $edit->contact_number }}" class="form-control" placeholder="Contact Number">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" name="contact_email" value="{{$edit->contact_email}}" class="form-control" placeholder="Contact Email">
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
