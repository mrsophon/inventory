@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Employee Page </h4><br><br>

                        <form method="post" action="{{ route('employee.update') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $employee->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Name </label>
                                <div class="form-group col-sm-10">
                                    <input name="name" value="{{ $employee->name }}" class="form-control" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Employee Type </label>
                                <div class="col-sm-10">
                                    <select name="emptype_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>
                                        @foreach($emptype as $empt)
                                        <option value="{{ $empt->id }}"
                                            {{ $empt->id == $employee->emptype_id ? 'selected' : '' }}>{{ $empt->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Mobile </label>
                                <div class="form-group col-sm-10">
                                    <input name="mobile_no" value="{{ $employee->mobile_no }}" class="form-control"
                                        type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Email </label>
                                <div class="form-group col-sm-10">
                                    <input name="email" value="{{ $employee->email }}" class="form-control"
                                        type="email">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Address
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="address" value="{{ $employee->address }}" class="form-control"
                                        type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Image </label>
                                <div class="form-group col-sm-10">
                                    <input name="employee_image" class="form-control" type="file" id="image">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg"
                                        src="{{ asset($employee->employee_image) }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Employee">
                            <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#myForm').validate({
        rules: {
            name: {
                required: true,
            },
            emptype_id: {
                required: true,
            },
            mobile_no: {
                required: true,
            },
            email: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: 'Please Enter Your Name',
            },
            emptype_id: {
                required: 'Please Select One Employee Type',
            },
            mobile_no: {
                required: 'Please Enter Your Mobile Number',
            },
            email: {
                required: 'Please Enter Your Email',
            },
            address: {
                required: 'Please Enter Your Address',
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>

@endsection