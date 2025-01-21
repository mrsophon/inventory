@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Employee Type</h4><br><br>

                        <form method="post" action="{{ route('emptype.update') }}" id="myForm">
                            @csrf

                            <input type="hidden" name="id" value="{{ $emptype->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Type Name</label>
                                <div class="form-group col-sm-10">
                                    <input name="name" value="{{ $emptype->name }}" class="form-control" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-primary waves-effect waves-light" value="  Save  ">
                            <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please Enter Name',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

@endsection
