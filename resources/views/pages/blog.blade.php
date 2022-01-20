@extends('layouts.app')

@section('content')
@include('layouts.menubar')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/blog_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/styles/blog_responsive.css')}}">

	<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
						<!-- Blog post -->
                        @foreach($blog as $row)
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset($row->post_image)}})"></div>
                            @if(Session::get('lang')=='arbic')
                            <div class="blog_text">{{$row->post_title_ar}}</div>
                            @else
                            <div class="blog_text">{{$row->post_title_en}}</div>
                            @endif
							
                            @if(Session::get('lang')=='arbic')
                            <div class="blog_button"><a href="{{url('blog/single/'.$row->id)}}">الاستمرار بالقراءة</a></div>
                            @else
                            <div class="blog_button"><a href="{{url('blog/single/'.$row->id)}}">Continue Reading</a></div>
                            @endif
							
						</div>

						@endforeach
					</div>
				</div>
					
			</div>
		</div>
	</div>

@endsection