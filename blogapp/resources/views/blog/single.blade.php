@extends('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', " $titleTag")

@section('stylesheets')
<meta property="fb:app_id" content="536484133186724" />
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=536484133186724";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
{!! Html::style('css/wysiwyg.css') !!}
{!! Html::style('css/typeahead.css') !!}
@stop
@section('content')
<div class="row">
       <!--facebook starts-->
        <div class="fb-follow" style="text-indent: 0px;margin: 0px;padding: 0px;background: transparent;border-style: none;float: none;line-height: normal;font-size: 1px;vertical-align: baseline;display: inline-block;height: 20px;" data-href="https://www.facebook.com/foodquo" data-layout="button_count" data-size="small" data-show-faces="true"></div>
        <!--facebook ends-->
        <!--google starts-->
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/1/102371901214847126190" data-rel="author"></div>
        <!--google ends-->
        <!--twitter starts-->
        <a class="twitter-follow-button"
          href="https://twitter.com/FoodQuo">
        Follow @FoodQuo</a>
        <!--twitter ends-->

</div>
<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1>{{ ucwords($post->title) }}</h1>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{date('M j,Y \a\t g A',strtotime($post->created_at))}}</p>
        <!--facebook like button-->
        <div style="text-indent: 0px;margin: 0px;padding: 0px;background: transparent;border-style: none;float: none;line-height: normal;font-size: 1px;vertical-align: baseline;display: inline-block;height: 20px;" class="fb-like" data-href="{{Request::url()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
        <!--ends-->
        <!--facebook share-->
        <div style="text-indent: 0px;margin: 0px;padding: 0px;background: transparent;border-style: none;float: none;line-height: normal;font-size: 1px;vertical-align: baseline;display: inline-block;height: 20px;" class="fb-share-button" data-href="{{Request::url()}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank"  href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
        <!--ends-->
        <!-- Place this tag where you want the share button to render. -->
        <div class="g-plus" data-action="share"></div>
        <!-- google share-->
        <hr>

        {!! $post->body !!}
        @if($post->tags()->count()>0)
        <p>Tags:
            @foreach($post->tags as $tag)
            <span class="label label-default">{{$tag->name}}</span>
             @endforeach
            </p>
        @endif
        @if($post->category()->count()>0)
        <p>Posted In: <span class="label label-default">{{ $post->category->name }}</span></p>
        @endif
        <div class="pull-left">
          <!--facebook like button-->
        <div style="text-indent: 0px;margin: 0px;padding: 0px;background: transparent;border-style: none;float: none;line-height: normal;font-size: 1px;vertical-align: baseline;display: inline-block;height: 20px;" class="fb-like" data-href="{{Request::url()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
        <!--ends-->
        <!--facebook share-->
        <div style="text-indent: 0px;margin: 0px;padding: 0px;background: transparent;border-style: none;float: none;line-height: normal;font-size: 1px;vertical-align: baseline;display: inline-block;height: 20px;" class="fb-share-button" data-href="{{Request::url()}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank"  href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
        <!--ends-->
        <!-- Place this tag where you want the share button to render. -->
        <div class="g-plus" data-action="share"></div>
        <!-- google share-->
        </div>
         <!-- Author -->
        <div class="pull-right">
            <img src="\{{$post->users->profile->profile_image_path}}" class="img-rounded" width="80" height="80">
            <br>
           <a href="{{ route('profile.show',$post->users->username) }}">{{ucwords($post->users->name)}}</a>
            <br>
            @if(!is_null($post->users->profile->pen_name))
            <strong>{{$post->users->profile->pen_name}}</strong>
            @endif
        </div>
        <!-- Blog Comments -->

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="fb-comments" width="100%"></div>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            {{Form::open(['route'=>'blog.searchResults','method'=>'GET'])}}
            <div class="input-group">
                  <input type="text" class="form-control typeahead" name="search" autocomplete="off" spellcheck="false">
                <span class="input-group-btn">
                    <button class="btn btn-default" type= "submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
            <!-- /.input-group -->
            {{Form::close()}}
        </div>

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Categories</h4>
            <div class="row">
             <div class="col-lg-12">
		            @foreach($categories as $category)
                     <span class="label label-default"><a class="blog-cat-tag-links" href="{{ route('blog.query',[$category->id,'category']) }}">{{$category->name}}</a></span>
		            @endforeach
             </div>
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <div class="well">
            <h4>Tags</h4>
           <div class="row">
             <div class="col-lg-12">
                    @foreach($tags as $tag)
                     <span class="label label-default"><a class="blog-cat-tag-links" href="{{ route('blog.query',[$tag->id,'tag']) }}">{{$tag->name}}</a></span>
                    @endforeach
             </div>
            </div>
            <!-- /.row -->
        </div>

    </div>

</div>
<!-- /.row -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5875448b53adc693"></script>
@endsection


@section('scripts')
<script src="https://apis.google.com/js/platform.js" async defer></script>

{!! Html::script('js/typeahead.js')!!}
<script type="text/javascript">
$(document).ready(function(){
    // Sonstructs the suggestion engine
    var prefetchResults = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        // The url points to a json file that contains an array of country names
        prefetch: '{{ route('blog.prefetchResults') }}'
    });

    // Initializing the typeahead with remote dataset
    $('.typeahead').typeahead(null, {
        name: 'prefetchResults',
        source: prefetchResults,
        limit: 10 /* Specify maximum number of suggestions to be displayed */
    });
});
</script>
@stop
