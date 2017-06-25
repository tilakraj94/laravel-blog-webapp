@extends('main')

@section('title', ' All Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Action</th>
						
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td>{{ $category->name }}</td>
						<td>
						<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						{!!Form::open(['route'=>['categories.destroy',$category->id],'method' => 'DELETE' , 'id'=>$category->id,'class'=>'existing','style'=>'display:initial;'])!!}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
						{!!Form::close()!!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
					<h2>New Category</h2>
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}

					{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('scripts')
<script>
	$().ready(function(){
		$('form.existing').on('submit',function(e){
			var form_id=$(this).context.id;
			var conf=confirm("Do you really want to remove this category.Deleting the category will delete all the posts related to it?");
			if(conf)
				return true;
			return false;
		})
	})
</script>
@stop