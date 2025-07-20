@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Product Page </h4><br><br>

                        <form method="post" action="{{ route('product.store') }}" id="myForm">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Product Name </label>
                                <div class="form-group col-sm-10">
                                    <input id="name" name="name" class="form-control" type="text">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description </label>
                                <div class="form-group col-sm-10">
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier </label>
                                <div class="col-sm-10">
                                    <select id="supplier_id" name="supplier_id" class="form-select" aria-label="Default select example">
                                        <option selected value="">Please Select...</option>
                                        @foreach($supplier as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="unit_id" class="col-sm-2 col-form-label">Unit </label>
                                <div class="col-sm-10">
                                    <select id="unit_id" name="unit_id" class="form-select" aria-label="Default select example">
                                        <option selected value="">Please Select...</option>
                                        @foreach($unit as $uni)
                                        <option value="{{ $uni->id }}">{{ $uni->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="category_id" class="col-sm-2 col-form-label">Category </label>
                                <div class="col-sm-10">
                                    <select id="category_id" name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected value="">Please Select...</option>
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity </label>
                                <div class="form-group col-sm-3">
                                    <input id="quantity" name="quantity" type="text" class="form-control" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                            <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                            <button class="btn btn-warning waves-effect waves-light" onclick="">Delete Image</button>
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
            supplier_id: {
                required: true,
            },
            unit_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: 'Please Enter Your Product Name',
            },
            supplier_id: {
                required: 'Please Select One Supplier',
            },
            unit_id: {
                required: 'Please Select One Unit',
            },
            category_id: {
                required: 'Please Select One Category',
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new AutoNumeric('#quantity', {
            digitGroupSeparator: ',',
            decimalCharacter: '.',
            decimalPlaces: 4,
            minimumValue: '0',
            maximumValue: '9999999999.9999',
            unformatOnSubmit: true
        });
    });
</script>

@endsection