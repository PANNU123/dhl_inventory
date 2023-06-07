@extends('master')
@section('content')
    @include('includes.breadcrumb',['breadcrumb' => 'Request Product'])

        <section class="content">
            <div class="container-fluid">
                <div class="row pb-3 justify-content-between">
                    <div class="col-2">
                        <a type="button">-</a>
                    </div>
                    <div class="col-1">
                        <a href="{{route('backend.request.product.create')}}" class="btn btn-block btn-danger">Add New</a>
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
                            <h3 class="card-title">Request Product Table</h3>
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Route Name</th>
                                    <th>Quantity</th>
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
                    url: "{{route('backend.request.product.commercial')}}",
                },
                columns: [
                    {
                        data: 'Product_Name',
                        name: 'Product_Name'
                    },
                    {
                        data: 'Route_Name',
                        name: 'Route_Name'
                    },
                    {
                        data: 'Quantity',
                        name: 'Quantity'
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
