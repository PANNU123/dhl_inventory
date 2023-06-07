@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Category'])

<section class="content">
  <div class="container-fluid">
    <div class="row pb-3 justify-content-between">
      <div class="col-2">
        <a type="button">-</a>
      </div>
      <div class="col-2">
        <a href="{{route('backend.route.create')}}" class="btn btn-block btn-danger">Add New</a>
      </div>
    </div>
  </div>
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <h3 class="card-title">Category Table</h3>
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
</section>
@endsection
@push('post_scripts')
<script>
    $(function () {
      $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         ajax: {
            url: "{{route('backend.route')}}",
        },
        columns: [
            {
                data: 'Name',
                name: 'Name'
            },
            {
                data: 'Code',
                name: 'Code'
            },
            {
                data: 'Status',
                name: 'Status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
      });
    });
  </script>




@endpush
