@extends('layouts.app')

@section('content')
@foreach($post as $row)
<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">
                    @if(Session::get('lang')=='arbic')
                            {{$row->post_title_ar}}
                            @else
                            {{$row->post_title_en}}
                            @endif
                    </div>
					<div class="single_post_text">

                    @if(Session::get('lang')=='arbic')
                         {!! $row->details_ar!!}
                            @else
                            {!! $row->details_en!!}
                            @endif
				</div>
				</div>
			</div>
		</div>
	</div>

@endforeach
    @endsection