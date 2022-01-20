@extends('admin.admin_layouts')
<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Ecommerce</a>
            <span class="breadcrumb-item active">Product Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Product Add</h6>
                <p class="mg-b-20 mg-sm-b-30"> Product Add
                    <a href="{{ route('all.product')}}" class="btn btn-sm btn-success" style="float: right;" >ALL Product</a>
                </p>
                <form method="post" action="{{ route('store.product') }}"  enctype="multipart/form-data">
                    @csrf
                <div class="form-layout">



                    <div class="row mg-b-25">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_name"  placeholder="Enter Product Name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product code: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_code"  placeholder="Enter Product code">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="quantity" placeholder="Enter Quantity">
                            </div>

                    </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                                   @foreach($category as $row)
                                    <option value="{{$row->id}}">{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose Sub Category" name="subcategory_id">

                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Choose brand" name="brand_id">

                                    @foreach($brand as $ba)
                                    <option value="{{$ba->id}}">{{$ba->brand_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_size" id="size"  data-role="tagsinput" >
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="product_color" id="color"  data-role="tagsinput" >
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="selling_price"  placeholder="Selling Price" >
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Product Detail: <span class="tx-danger">*</span></label>
                                <textarea  class="form-control" name="product_detail"  id="summernote"></textarea>

                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Vedio Link: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="viedo_link"  placeholder="viedo link"  >
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image One (Main Thumbnails): <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="one">
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image Tow (Main Thumbnails): <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_tow" onchange="readURL2(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="tow">
                                </label>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Image three (Main Thumbnails): <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL3(this);" required="">
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="three">
                                </label>
                            </div>

                        </div>
                    </div>
                    <!-- row -->
                    <hr>
                    <br><br>

                    <div class="row ">
                        <div class="col-lg-4">
                            <div class="form-group">
                                 <label class="ckbox">
                                    <input type="checkbox" name="hot_deal" value="1">
                                    <span>Hot Deal</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="main_slider" value="1">
                                    <span>Main Slider</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="best_rated" value="1">
                                    <span>Best Rated</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="trend_product" value="1">
                                    <span>Trend product</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="mid_slider" value="1">
                                    <span>Mid Slider</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="hot_new" value="1">
                                    <span>Hot New</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="buyone_getone" value="1">
                                    <span>Buyone Getone</span>
                                </label>
                            </div>
                        </div><!-- col-4 -->

                    </div>
                        <!-- row -->
                    <br>
                    <br>




                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Submit Form</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
                </form>
            </div><!-- card -->

        </div><!-- card -->
    </div>
        <!-- ########## END: MAIN PANEL ########## -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="category_id"]').on('change',function(){
                var category_id = $(this).val();
                if (category_id) {

                    $.ajax({
                        url: "{{ url('/get/subcategory/') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){

                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                            });
                        },
                    });

                }else{
                    alert('danger');
                }

            });
        });

    </script>



    <script type="text/javascript">
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL2(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tow')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL3(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
