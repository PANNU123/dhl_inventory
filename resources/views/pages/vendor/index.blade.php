@extends('master')
@section('content')
    @include('includes.breadcrumb',['breadcrumb' => 'UOM'])

    <section class="content">
        <div class="container-fluid">
            <div class="row pb-3 justify-content-between">
                <div class="col-2">
                    <a type="button">-</a>
                </div>
                <div class="col-1">
                    <a href="{{route('backend.vendor.create')}}" class="btn btn-block btn-danger">Add New</a>
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
                                    <th>SAP Vendor Code</th>
                                    <th>Get Vendor Code</th>
                                    <th>Vendor's Name</th>
{{--                                    <th>Vendor's Address</th>--}}
                                    <th>Contact Person's Name</th>
                                    <th>Contact Number</th>
{{--                                    <th>Contact Email</th>--}}
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
                    url: "{{route('backend.vendor')}}",
                },
                columns: [
                    {
                        data: 'SAP_Vendor_Code',
                        name: 'SAP_Vendor_Code'
                    },
                    {
                        data: 'Get_Vendor_Code',
                        name: 'Get_Vendor_Code'
                    },
                    {
                        data: 'Vendors_Name',
                        name: 'Vendors_Name'
                    },
                    // {
                    //     data: 'Vendors_Address',
                    //     name: 'Vendors_Address'
                    // },
                    {
                        data: 'Contact_Persons_Name',
                        name: 'Contact_Persons_Name'
                    },
                    {
                        data: 'Contact_Number',
                        name: 'Contact_Number'
                    },
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
