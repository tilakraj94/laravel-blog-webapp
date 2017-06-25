@extends('main')

@section('title', "$tag->name")

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1><span class="tags-show-span-tag">{{$tag->name}}</span> Tag <small>{{$tag->posts()->count()}} Posts</small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tags.edit',$tag->id) }}" class="btn tags-show-btn btn-sm btn-primary btn-block">Edit</a>
		</div>
		<div class="col-md-2">
			{!!Form::open(['route'=>['tags.destroy',$tag->id],'method'=>'DELETE','class'=>'tags-show-btn'])!!}
			{{Form::submit('Delete',['class'=>'btn btn-block btn-danger btn-sm'])}}
			{!!Form::close()!!}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Tags</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td>{{$post->title}}</td>
						<td>
							@foreach($post->tags as $tagg)
							<span class="label label-default">{{$tagg->name}}</span>
							@endforeach
						</td>
						<td><a href="{{ route('posts.show',$post->id) }}" class="btn btn-default btn-sm">View</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection