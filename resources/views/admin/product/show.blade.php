@extends('admin.admin_layouts')


@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Ecommerce</a>
            <span class="breadcrumb-item active">Product Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Product Details</h6>

                    <div class="form-layout">



                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label><br>
                                   <strong> {{ $product->product_name }}</strong>
                                     </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product code: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->product_code }}</strong>
                                       </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->product_quantity }}</strong>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->category_name }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->subcategory_name }}</strong>

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->brand_name }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->product_size }}</strong>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->product_color }}</strong>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->selling_price}}</strong>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Detail: <span class="tx-danger">*</span></label><br>
                                    <strong> {!! $product->product_details !!} </strong>

                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Vedio Link: <span class="tx-danger">*</span></label><br>
                                    <strong> {{ $product->video_link}}</strong>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image One (Main Thumbnails): <span class="tx-danger">*</span></label>
                                    <label class="custom-file">

                                    </label><br>
                                    <img src="{{url($product->image_one)}}" style="width: 80px; height:80px;">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image Tow (Main Thumbnails): <span class="tx-danger">*</span></label>
                                    <label class="custom-file">

                                    </label><br>
                                    <img src="{{url($product->image_tow)}}" style="width: 80px; height:80px;">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image three (Main Thumbnails): <span class="tx-danger">*</span></label>
                                    <label class="custom-file">

                                    </label><br>
                                    <img src="{{url($product->image_three)}}" style="width: 80px; height:80px;">
                                </div>

                            </div>
                        </div>
                        <!-- row -->
                        <hr>
                        <br><br>

                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>
                                        @if($product->hot_deal==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        <span>Hot Deal</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label >
                                        @if($product->main_slider==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Main Slider</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label >
                                        @if($product->best_rated ==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Best Rated</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="">
                                        @if($product->trend ==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Be
                                        <span>Trend product</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="">
                                        @if($product->mid_slider ==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Be
                                        <span>Mid Slider</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="">
                                        @if($product->hot_new ==1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                        <span>Be
                                        <span>Hot New</span>
                                    </label>
                                </div>
                            </div><!-- col-4 -->

                        </div>




                    </div><!-- form-layout -->

            </div><!-- card -->

        </div><!-- card -->
    </div>


@endsection
