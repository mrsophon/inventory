@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Employee All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('employee.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                            style="float:right;"><i class="fas fa-plus-circle"><span
                                    style="font-family:tahoma; font-weight: normal;"> Add Employee </span></i></a> <br>
                        <br>

                        <h4 class="card-title">Employee All Data </h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Employee Image </th>
                                    <th>Employee Type</th>
                                    <!-- <th>Email</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($employees as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> <img src="{{ asset( $item->employee_image ) }}"
                                            style="width:60px; height:50px"> </td>
                                    <td> {{ $item['emptype']['name'] }} </td>
                                    <!-- <td> {{ $item->email }} </td> -->
                                    <td>
                                        <a href="{{ route('employee.edit',$item->id) }}" class="btn btn-info sm"
                                            title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('employee.delete',$item->id) }}" class="btn btn-danger sm"
                                            title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>

@endsection