@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">


        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Newslater Subscrib</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Newslater Subscrib List
                    <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">All Deleted</a>
                </h6>


                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Email</th>
                            <th class="wd-15p">Subscrubing Time</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newslater as $key=>$row)
                            <tr>
                                <td> <input type="checkbox" > {{ $key +1 }} </td>
                                <td>{{ $row->email }}</td>
                                <td> {{\Carbon\Carbon::parse( $row->created_at )->diffForhumans()}} </td>
                                <td>
                                    <a href="{{url('delete/newslate/'.$row->id)}}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->




        </div><!-- sl-mainpanel -->



        <!-- LARGE MODAL -->




@endsection
