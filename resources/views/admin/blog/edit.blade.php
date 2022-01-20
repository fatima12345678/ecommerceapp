@extends('admin.admin_layouts')


@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Ecommerce</a>
            <span class="breadcrumb-item active">Blog Section</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Post Add</h6>
                <p class="mg-b-20 mg-sm-b-30"> Post Add
                </p>
                <form method="post" action="{{ url('update/post/'.$post->id) }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">



                        <div class="row mg-b-25">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (English): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="post_title_en"  value="{{$post->post_title_en}}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Post Title (Arbic): <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="post_title_ar"   value="{{$post->post_title_ar}}">
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blog Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                                        @foreach($blogcat as $row)

                                            <option value="{{$row->id}}"
                                                <?php if($row->id==$post->category_id) {echo "selected";} ?>>
                                                {{$row->category_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Detail (English): <span class="tx-danger">*</span></label>
                                    <textarea  class="form-control" name="details_en"  id="summernote">

                                     {!! $post->details_en !!}

                                    </textarea>

                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Post Detail (Arbic): <span class="tx-danger">*</span></label>
                                    <textarea  class="form-control" name="details_ar"  id="summernote1">

                                        {!! $post->details_ar !!}

                                    </textarea>

                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Post Image: <span class="tx-danger">*</span></label>
                                    <label class="custom-file">
                                        <input type="file" id="file" class="custom-file-input" name="post_image" onchange="readURL(this);" >
                                        <span class="custom-file-control"></span>
                                        <img src="#" id="one">
                                    </label>
                                </div><br><br><br>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Old Post Image: <span class="tx-danger">*</span></label>
                                    <label class="custom-file">


                                    </label>
                                    <img src="{{url($post->post_image)}}"  style="width: 80px; height: 80px;">
                                    <input type="hidden" name="old_image" value="{{$post->post_image}}">
                                </div><br><br><br>

                            </div>

                        </div>
                        <!-- row -->







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

@endsection
