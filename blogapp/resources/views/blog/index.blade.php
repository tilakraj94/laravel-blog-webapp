@extends('main')

@section('title', ' Blog')

@section('content')
	@foreach ($posts as $post)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			 <h2>
                 <h3>{{ ucwords($post->title) }}</h3>
                </h2>
                <p class="lead">
                    by <a href="{{ route('profile.show',$post->users->username) }}">{{ucwords($post->users->name)}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{date('M j,Y \a\t g A',strtotime($post->created_at))}}</p>
                
                @if(!is_null($post->display_image_path))
                <hr>
                <img class="img-responsive" src="{{$post->display_image_path}}" alt="">
                @endif
                <hr>
                <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p>
                <a class="btn btn-primary" href="{{ url('blog/'.$post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
		</div>
	</div>
	@endforeach

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>


@endsection