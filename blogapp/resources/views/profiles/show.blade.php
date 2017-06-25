@extends('main')
@section('title',"Profile")


@section('stylesheets')
{!!Html::style('css/profile_grid_view.css')!!}
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
	   <div class="span3 well">
        <center>
                  <center>
                    <img src="\{{$user->profile->profile_image_path}}" name="aboutme" width="140" height="140" border="0" class="img-circle" alt="No image"></a>
                    <h3 class="media-heading">{{ucwords($user->name)}}</h3>
										@if(!empty($user->profile->pen_name))
                    <span><strong>{{$user->profile->pen_name}}</strong></span>
										@endif
                    <br>
                    @if(!empty($user->profile->insta_link))
                        <span class="label label-warning"><a href="{{$user->profile->insta_link}}" class="blog-cat-tag-links">Instagram</a></span>
                    @endif
                    @if(!empty($user->profile->facebook_link))
                        <span class="label label-info"><a href="{{$user->profile->facebook_link}}" class="blog-cat-tag-links">Facebook</a></span>
                    @endif
                    @if(!empty($user->profile->google_link))
                        <span class="label label-info"><a href="{{$user->profile->google_link}}" class="blog-cat-tag-links">Google+</a></span>
                    @endif
                    @if(!empty($user->profile->twitter_link))
                        <span class="label label-success"><a href="{{$user->profile->twitter_link}}" class="blog-cat-tag-links">Twitter</a></span>
                    @endif
                    </center>
                    <hr>
										@if(!empty($user->profile->about))
                    <center>
                    <br>
                        {{$user->profile->about}}
                    <br>
                    </center>
										@endif
		</center>
      </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		    <div class="well well-sm">
		        <center><strong>Recent Posts of the blogger</strong></center>
		    </div>
		    <div id="products" class="row list-group">

		    @foreach($user->posts()->orderBy('created_at','desc')->get() as $post)
		        <div class="item  col-lg-4">
		            <div class="thumbnail">
                    <a href="{{ route('posts.show',$post->id) }}"><img class="group list-group-image" src="{{$post->display_image_path}}" alt="No image" /> </a>
		                <div class="caption">
		                   <center><h4 class="group inner list-group-item-heading">
		                        {{ ucwords($post->title) }}</h4>
		                        <p class="group inner list-group-item-text">
		                    {{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : ""}}
		                    </p></center>
		                </div>
		            </div>
		        </div>
		        @endforeach
		    </div>

	</div>
</div>
@stop
