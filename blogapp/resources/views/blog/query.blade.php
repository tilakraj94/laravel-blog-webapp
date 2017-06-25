@extends('main')

@section('title', ' Blog')

@section('content')

	@foreach ($query as $post)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>{{ ucwords($post->title) }}</h2>
			<p class="lead">
                    by <a href="{{ route('profile.show',$post->username) }}">{{ucwords($post->name)}}</a>
                </p>
			 <p><span class="glyphicon glyphicon-time"></span> Posted on {{date('M j,Y \a\t g A',strtotime($post->created_at))}}</p>
			 @if(!is_null($post->display_image_path))
                <hr>
                <img class="img-responsive" src="{{$post->display_image_path}}" alt="">
                @endif
                <hr>
			<p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }}</p>

			<a href="{{ route('blog.single', $post->slug) }}" class="btn btn-sm btn-primary">Read More</a>
			<hr>
		</div>
	</div>
	@endforeach

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $query->links() !!}
			</div>
		</div>
	</div>


@endsection