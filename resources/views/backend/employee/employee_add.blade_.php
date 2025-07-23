@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Employee Page </h4><br><br>

                        <form method="post" action="{{ route('employee.store') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Employee Name : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Type : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="emptype_id" name="emptype_id" aria-label="Select Type">
                                        <option selected value="">Please Select...</option>
                                        @foreach($emptype as $empt)
                                        <option value="{{ $empt->id }}">{{ $empt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="mobile_no" class="col-sm-2 col-form-label">Mobile : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                                <div class="form-group col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Address : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="employee_image" class="col-sm-2 col-form-label">Image : </label>
                                <div class="form-group col-sm-10">
                                    <input type="file" class="form-control" id="employee_image" name="employee_image">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="showImage" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="showImage" name="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Employee Image">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="  Save  ">
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
            employee_image: {
                required: true,
            }
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
            employee_image: {
                required: 'Please Select One Image',
            }
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
    $('#employee_image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>

@endsection