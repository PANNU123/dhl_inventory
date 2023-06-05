@extends('master')
@section('content')
    @include('includes.breadcrumb',['breadcrumb' => 'Reports'])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-12 col-md-10 float-left">
                                <h2 class="card-title">Reports List's</h2>
                            </div>
                            <div class="col-sm-12 col-md-2 float-right">
                                <div class="btn-group float-right">
                                    <button type="button" class="btn btn-dark"><i class="fa fa-gear"></i></button>
                                    <button type="button" class="btn btn-dark dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                                <div class="float-right mr-1">
                                    <button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-2">
                                        <level>Start Date</level>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <level>End Date</level>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <level>Category</level>
                                        <select class="form-control">
                                            <option>Category 1</option>
                                            <option>Category 1</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <level>Item Code</level>
                                        <input type="text" name="start_date" class="form-control" placeholder="Item Code">
                                    </div>
                                    <div class="col-sm-12 col-md-2">
                                        <level>Item Name</level>
                                        <input type="text" name="start_date" class="form-control" placeholder="Item Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                               aria-describedby="example2_info">
                                            <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">
                                                    Product Category
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending">
                                                    Product Sub-Category
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                    Product Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending">
                                                    UoM
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Opening Stock
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Received During The Period
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Issued During The Period
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                    Closing Stock(At Central Store,Sub-Stores,In-Transit)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            <tr class="even">
                                                <td class="dtr-control sorting_1" tabindex="0">Category 1</td>
                                                <td>Sub Cat 1</td>
                                                <td>Product 1</td>
                                                <td>14</td>
                                                <td>99</td>
                                                <td>7</td>
                                                <td>6</td>
                                                <td>76</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                            Showing 1 to 10 of 57 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="example2_previous"><a href="#" aria-controls="example2"
                                                                              data-dt-idx="0" tabindex="0"
                                                                              class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                                                                aria-controls="example2"
                                                                                                data-dt-idx="1" tabindex="0"
                                                                                                class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                          data-dt-idx="2" tabindex="0"
                                                                                          class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                          data-dt-idx="3" tabindex="0"
                                                                                          class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                          data-dt-idx="4" tabindex="0"
                                                                                          class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                          data-dt-idx="5" tabindex="0"
                                                                                          class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                                                                          data-dt-idx="6" tabindex="0"
                                                                                          class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                                                                                                 aria-controls="example2"
                                                                                                                 data-dt-idx="7"
                                                                                                                 tabindex="0"
                                                                                                                 class="page-link">Next</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
@endsection

