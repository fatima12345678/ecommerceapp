@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">


        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand Update</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{url('update/brand/'.$brand->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brand->brand_name}}" name="brand_name">

                            <label for="exampleInputEmail1">Brand logo</label>
                            <input type="file" class="form-control"  aria-describedby="emailHelp" placeholder="brand logo" name="brand_logo">


                            <label for="exampleInputEmail1">Old Brand logo</label>
                            <img src="{{url($brand->brand_logo)}}" height="70px" width="90px">
                            <input type="hidden" value="{{$brand->brand_logo}}"  name="old_logo">


                        </div>


                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    </div>
                </form>




            </div><!-- card -->




        </div><!-- sl-mainpanel -->






@endsection
