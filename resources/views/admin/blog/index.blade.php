@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">


        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Blog Category Table</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Blog Category List
                    <a href="{{route('add.blogpost')}}" class="btn btn-sm btn-warning" style="float: right;" >Add New Post</a>
                </h6>


                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">Post Title</th>
                            <th class="wd-15p">Post Category</th>
                            <th class="wd-15p">Post Image</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($post as $key=>$row)
                            <tr>
                                <td>{{$row->post_title_en }}</td>
                                <td>{{ $row->category_name_en }}</td>
                                <td><img src="{{ url($row->post_image)}}" style="width: 80px; height: 80px;"></td>
                                <td>
                                    <a href="{{url('edit/post/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{url('delete/post/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->




        </div><!-- sl-mainpanel -->





@endsection
