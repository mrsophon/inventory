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

                        <form method="post" action="{{ route('product.store') }}" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Product Name : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="item_desc" class="col-sm-2 col-form-label">Description : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="item_desc" name="item_desc" rows="3"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="dimension" class="col-sm-2 col-form-label">Dimension : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="dimension" name="dimension">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="stn_desc" class="col-sm-2 col-form-label">Stone Description : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="stn_desc" name="stn_desc" rows="3"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="item_set" class="col-sm-2 col-form-label">Set : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="item_set" name="item_set">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="brand_id" class="col-sm-2 col-form-label">Brand : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select select2" id="brand_id" name="brand_id" aria-label="Select Brand">
                                        <option selected value="">Please Select...</option>
                                        @foreach($brand as $brn)
                                            <option value="{{ $brn->id }}">{{ $brn->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select select2" id="supplier_id" name="supplier_id" aria-label="Select Supplier">
                                        <option selected value="">Please Select...</option>
                                        @foreach($supplier as $supp)
                                            <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="category_id" class="col-sm-2 col-form-label">Category : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select select2" id="category_id" name="category_id" aria-label="Select Category">
                                        <option selected value="">Please Select...</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="type_id" class="col-sm-2 col-form-label">Type : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select select2" id="type_id" name="type_id" aria-label="Select Type">
                                        <option selected value="">Please Select...</option>
                                        @foreach($type as $typ)
                                            <option value="{{ $typ->id }}">{{ $typ->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="unit_id" class="col-sm-2 col-form-label">Unit : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select" id="unit_id" name="unit_id" aria-label="Select Unit">
                                        <option selected value="">Please Select...</option>
                                        @foreach($unit as $uni)
                                            <option value="{{ $uni->id }}">{{ $uni->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="cost" class="col-sm-2 col-form-label">Cost : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="cost" name="cost" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="price_baht" class="col-sm-2 col-form-label">Price Baht : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="price_baht" name="price_baht" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="price_range" class="col-sm-2 col-form-label">Price Range : </label>
                                <div class="form-group col-sm-10">
                                    <input type="text" class="form-control" id="price_range" name="price_range">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="vattype_id" class="col-sm-2 col-form-label">Vat Type : </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select" id="vattype_id" name="vattype_id" aria-label="Select Vat Type">
                                        <option selected value="">Please Select...</option>
                                        @foreach($vattype as $vattyp)
                                            <option value="{{ $vattyp->id }}">{{ $vattyp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="metal_wgt" class="col-sm-2 col-form-label">Metal Weight : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="metal_wgt" name="metal_wgt" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="gold_wgt" class="col-sm-2 col-form-label">Gold Weight : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="gold_wgt" name="gold_wgt" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="net_wgt" class="col-sm-2 col-form-label">Net Weight : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="net_wgt" name="net_wgt" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="pdate" class="col-sm-2 col-form-label">Date : </label>
                                <div class="form-group col-sm-3">
                                    <input type="date" class="form-control example-pdate-input" id="pdate" name="pdate" value="{{ old('pdate', $pdate) }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="note" class="col-sm-2 col-form-label">Note : </label>
                                <div class="form-group col-sm-10">
                                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="stat" class="col-sm-2 col-form-label">Status : </label>
                                <div class="form-group col-sm-3">
                                    <select class="form-select" id="stat" name="stat" aria-label="Select Status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity : </label>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="0.0000">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="product_image" class="col-sm-2 col-form-label">Image : </label>
                                <div class="form-group col-sm-10">
                                    <input type="file" class="form-control" id="product_image" name="product_image" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="showImage" class="col-sm-2 col-form-label"> </label>
                                <div class="form-group col-sm-10">
                                    <a href="{{ url('upload/no_image.jpg') }}" data-fancybox="image" id="imageLink">
                                        <img class="rounded avatar-lg" id="showImage" name="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Product Image" style="object-fit:contain;">
                                    </a> &nbsp;
                                    <button type="button" class="btn btn-warning position-absolute top-0" id="btnDelImage" hidden>Delete Image</button>
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
                item_desc: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                type_id: {
                    required: true,
                },
                unit_id: {
                    required: true,
                },
                vattype_id: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: 'Please Enter Product Name',
                },
                item_desc: {
                    required: 'Please Enter Description',
                },
                brand_id: {
                    required: 'Please Select Brand',
                },
                category_id: {
                    required: 'Please Select Category',
                },
                type_id: {
                    required: 'Please Select Type',
                },
                unit_id: {
                    required: 'Please Select Unit',
                },
                vattype_id: {
                    required: 'Please Select Vat Type',
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
            }
        });

        $('#product_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
            $("#btnDelImage").prop("hidden", false);

            const file = this.files[0];
            if (file) {
                const fileURL = URL.createObjectURL(file); // Create a temporary URL for the selected file
                $('#imageLink').attr('href', fileURL);
            }
        });

        $('#btnDelImage').click(function() {
            $('#showImage').attr('src', "{{ url('upload/no_image.jpg') }}" );
            $('#product_image').val('');
            $("#btnDelImage").prop("hidden", true);
            $('#imageLink').attr('href', "{{ url('upload/no_image.jpg') }}" );
        });
    });

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