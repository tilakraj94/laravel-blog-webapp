@extends('main')

@section('title', 'View Post')


@section('stylesheets')
{!! Html::style('css/wysiwyg.css') !!}
@stop
@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			
			<p>{!! $post->body !!}</p>

			<hr>
			@if($post->tags()->count()>0)
			<div class="tags">
			Tags: 
				@foreach ($post->tags as $tag)
					<span class="label label-default">{{ $tag->name }}</span>
				@endforeach
			</div>
			@endif
			@if($post->category()->count()>0)
			<div>
					Posted In: <span class="label label-default">{{ $post->category->name }}</span>
			</div>
			@endif
			
		</div>
		<div class="col-md-4">
			<div class="well">
					<ul class="list-group">
					  <li class="list-group-item text-center">
					    <a hidden="hidden" class="blog-cat-tag-links" id="slug_url" href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a>
						<!-- Trigger -->
						<button class="btn btn-xs" id="clipboardCopy" data-clipboard-target="a#slug_url">
						    <i class="fa fa-clipboard" aria-hidden="true">&nbsp;&nbsp;Copy URL to clipboard.&nbsp;</i>
						</button>
					  </li>
					  <li class="list-group-item">
					    <span class="badge">{{ $post->category->name }}</span>
					    Category:
					  </li>
					  <li class="list-group-item">
					    <span class="badge">{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</span>
					    Created At:
					  </li>
					  <li class="list-group-item">
					    <span class="badge">{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</span>
					    Last Updated:
					  </li>
					</ul>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						{{ Html::linkRoute('posts.index', '<< See All Posts', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection

@section('scripts')
{!!Html::script('js/clipboard.min.js')!!}
<script>
		var clipboard = new Clipboard('.btn');

		clipboard.on('success', function(e) {
			setTooltip(e.trigger, 'Copied!');
            hideTooltip(e.trigger);
		    e.clearSelection();
		});

		clipboard.on('error', function(e) {
		    setTooltip(e.trigger, 'Failed!');
  			hideTooltip(e.trigger);
		});

		 $('button#clipboardCopy').tooltip({
		  trigger: 'click',
		  placement: 'bottom'
		});

		function setTooltip(btn, message) {
		  $(btn).tooltip('hide')
		    .attr('data-original-title', message)
		    .tooltip('show');
		}

		function hideTooltip(btn) {
		  setTimeout(function() {
		    $(btn).tooltip('hide');
		  }, 1000);
		}
</script>
@stop