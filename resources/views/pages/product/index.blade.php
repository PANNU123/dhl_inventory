@extends('master')
@section('content')
@include('includes.breadcrumb',['breadcrumb' => 'Product'])
<section class="content">
  <div class="container-fluid">
    <div class="row pb-3 justify-content-between">
      <div class="col-2">
        <a type="button">-</a>
      </div>
      <div class="col-2">
        <a href="{{route('backend.product.create')}}" class="btn btn-block btn-success">Add New</a>
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
                <h3 class="card-title">Product Table</h3>
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Vendor</th>
                  <th>Category</th>
                  <th>SubCategory</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Qty</th>
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
    <!-- /.container-fluid -->
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
          url: "{{route('backend.product')}}",
      },
      columns: [
        {
              data: 'Vendor',
              name: 'Vendor'
          },
          {
              data: 'Category',
              name: 'Category'
          },
          {
              data: 'Sub_Category',
              name: 'Sub_Category'
          },
          {
              data: 'Product',
              name: 'Product'
          },
          {
              data: 'Price',
              name: 'Price'
          },
          {
              data: 'Qty',
              name: 'Qty'
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