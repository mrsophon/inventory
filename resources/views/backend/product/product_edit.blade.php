@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Product Page </h4><br><br>

                        <form method="post" action="{{ route('product.update') }}" id="myForm">
                            @csrf

                            <input type="hidden" name="id" value="{{ $product->id }}">

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Product Name : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="item_desc" class="col-sm-2 col-form-label">Description : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="item_desc" name="item_desc" rows="3">{{ old('item_desc', $product->item_desc) }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="dimension" class="col-sm-2 col-form-label">Dimension : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="dimension" name="dimension" value="{{ old('dimension', $product->dimension) }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="item_set" class="col-sm-2 col-form-label">Product Set : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="item_set" name="item_set" value="{{ old('item_set', $product->item_set) }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="stn_desc" class="col-sm-2 col-form-label">Stone Description : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="stn_desc" name="stn_desc" rows="3">{{ old('stn_desc', $product->stn_desc) }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="supplier_id" name="supplier_id" aria-label="Select Supplier">
                                        <option selected="">Please Select...</option>
                                        @foreach($supplier as $supp)
                                        <option value="{{ $supp->id }}"
                                            {{ $supp->id == old('supplier_id', $product->supplier_id) ? 'selected' : '' }}>{{ $supp->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="unit_id" class="col-sm-2 col-form-label">Unit : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="unit_id" name="unit_id" aria-label="Select Unit">
                                        <option selected="">Please Select...</option>
                                        @foreach($unit as $uni)
                                        <option value="{{ $uni->id }}"
                                            {{ $uni->id == old('unit_id', $product->unit_id) ? 'selected' : '' }}>{{ $uni->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="category_id" class="col-sm-2 col-form-label">Category : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="category_id" name="category_id" aria-label="Select Category">
                                        <option selected="">Please Select...</option>
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="brand_id" class="col-sm-2 col-form-label">Brand : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="brand_id" name="brand_id" aria-label="Select Brand">
                                        <option selected="">Please Select...</option>
                                        @foreach($brand as $brn)
                                        <option value="{{ $brn->id }}"
                                            {{ $brn->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}>{{ $brn->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="type_id" class="col-sm-2 col-form-label">Type : </label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="type_id" name="type_id" aria-label="Select Type">
                                        <option selected="">Please Select...</option>
                                        @foreach($type as $typ)
                                        <option value="{{ $typ->id }}"
                                            {{ $typ->id == old('type_id', $product->type_id) ? 'selected' : '' }}>{{ $typ->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="cost" class="col-sm-2 col-form-label">Cost : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="cost" name="cost" value="{{ old('cost', $product->cost) }}" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="price_baht" class="col-sm-2 col-form-label">Price : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="price_baht" name="price_baht" value="{{ old('price_baht', $product->price_baht) }}" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="0.0000">
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