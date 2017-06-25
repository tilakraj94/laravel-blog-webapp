@extends('main')

@section('title', ' Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<script src="https://cdn.ckeditor.com/4.6.1/standard-all/ckeditor.js"></script>

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
		<div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          &nbsp;<strong>Note:</strong>Remember to <strong>Add atleast one image</strong> for the post.
        </div>

			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '')) !!}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title',old('title'), array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug',old('slug'), array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255') ) }}

				{{ Form::label('category_id', 'Category:') }}
				<select class="form-control" name="category_id">
					@foreach($categories as $key=>$value)
						<option value='{{ $key }}'>{{ $value }}</option>
					@endforeach
					

				</select>
               
				{{ Form::label('tags', 'Tags:') }}
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
					@endforeach
				</select>



				{{ Form::label('body', "Post Body:") }}
				{{ Form::textarea('body',old('body'), array('class' => 'form-control','id'=>'editor1')) }}

				{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection


@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();
		//They both vary for create and edit because , the directory path is something rendered at the source of 
		//ck editor, so for create it goes blog.foodquo.com/post/something and for create blog.foodquo.com/post/3/edit/something , to avoid this , i defined it in create and edit view and they are called inside the wysiwyg.js files.
		 var __wysiwygcsspath='../css/wysiwyg.css';
		 var __filebrowserBrowseUrl='../browser/browse.php?opener=ckeditor&type=files';
		 var __filebrowserBrowseUrl = '../browser/browse.php?opener=ckeditor&type=files';
		 var __filebrowserImageBrowseUrl ='../browser/browse.php?opener=ckeditor&type=images';
		 var __filebrowserFlashBrowseUrl = '../browser/browse.php?opener=ckeditor&type=flash';
		 var __filebrowserUploadUrl = '../browser/upload.php?opener=ckeditor&type=files';
		 var __filebrowserImageUploadUrl = '../browser/upload.php?opener=ckeditor&type=images';
		 var __filebrowserFlashUploadUrl = '../browser/upload.php?opener=ckeditor&type=flash';
	</script>
	{!! Html::script('js/wysiwyg.js') !!}
@endsection
