@extends('main')

@section('title', ' Edit Blog Post')

@section('stylesheets')

	{!! Html::style('css/select2.min.css') !!}
	<script src="https://cdn.ckeditor.com/4.6.1/standard-all/ckeditor.js"></script>


@endsection

@section('content')
	<div class="row">
	<div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          &nbsp;<strong>Note:</strong>Remember to <strong>Add atleast one image</strong> for the post.
        </div>
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title',old('title'), ["class" => 'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug',old('slug'), ['class' => 'form-control']) }}

			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			
			
             <select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $tag)
						<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
					@endforeach
			 </select>
			{{ Form::label('body', "Body:", ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body',old('body'), ['class' => 'form-control','id'=>'editor1']) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<ul class="list-group">
			
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
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>

			</div>
		</div>
		{!! Form::close() !!}
	</div>	<!-- end of .row (form) -->

@stop

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

		$('.select2-multi').select2();
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
			//They both vary for create and edit because , the directory path is something rendered at the source of 
		//ck editor, so for create it goes blog.foodquo.com/post/something and for create blog.foodquo.com/post/3/edit/something , to avoid this , i defined it in create and edit view and they are called inside the wysiwyg.js files.
		 var __wysiwygcsspath='../../css/wysiwyg.css';
		 var __filebrowserBrowseUrl='../../browser/browse.php?opener=ckeditor&type=files';
		 var __filebrowserBrowseUrl = '../../browser/browse.php?opener=ckeditor&type=files';
		 var __filebrowserImageBrowseUrl ='../../browser/browse.php?opener=ckeditor&type=images';
		 var __filebrowserFlashBrowseUrl = '../../browser/browse.php?opener=ckeditor&type=flash';
		 var __filebrowserUploadUrl = '../../browser/upload.php?opener=ckeditor&type=files';
		 var __filebrowserImageUploadUrl = '../../browser/upload.php?opener=ckeditor&type=images';
		 var __filebrowserFlashUploadUrl = '../../browser/upload.php?opener=ckeditor&type=flash';

	</script>
	{!! Html::script('js/wysiwyg.js') !!}
@endsection