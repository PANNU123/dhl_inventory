@extends('master')
@section('content')
    @include('includes.breadcrumb',['breadcrumb' => 'Vehicle'])

    <section class="content">
        <div class="container-fluid">
            <div class="row pb-3 justify-content-between">
                <div class="col-2">
                    <a type="button">-</a>
                </div>
                <div class="col-2">
                    <a href="{{route('backend.vehicle.create')}}" class="btn btn-block btn-success">Add New</a>
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
                            <h3 class="card-title">Vendor Table</h3>
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle CC</th>
                                    <th>Vehicle Engine Number</th>
                                    <th>Vehicle Chassis  Number</th>
{{--                                    <th>Vehicle Driver Name</th>--}}
{{--                                    <th>Vehicle Driver Number</th>--}}
{{--                                    <th>Vehicle Driver Email</th>--}}
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
                    url: "{{route('backend.vehicle')}}",
                },
                columns: [
                    {
                        data: 'Name',
                        name: 'Name'
                    },
                    {
                        data: 'Vehicle_Name',
                        name: 'Vehicle_Name'
                    },
                    {
                        data: 'Vehicle_CC',
                        name: 'Vehicle_CC'
                    },
                    {
                        data: 'Vehicle_Engine_Number',
                        name: 'Vehicle_Engine_Number'
                    },
                    {
                        data: 'Vehicle_Chassis_Number',
                        name: 'Vehicle_Chassis_Number'
                    },
                    // {
                    //     data: 'Contact_Number',
                    //     name: 'Contact_Number'
                    // },
                    // {
                    //     data: 'Contact_Email',
                    //     name: 'Contact_Email'
                    // },
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
