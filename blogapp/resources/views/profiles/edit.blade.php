@extends('main')
@section('title',"Edit Profile")

@section('content')
	<div class="row">
	{!!Form::model($user->profile,['route'=>['profile.update',$user->username],'files'=>true,'method'=>'PUT','class'=>'form-horizontal','role'=>'form'])!!}
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="\{{$user->profile->profile_image_path}}" width="100px" height="100px" class="avatar img-circle" alt="avatar">
          <h6>Upload a different photo?</h6>
          
          <input type="file" name="featured_image" accept="image/*" class="form-control">
        </div>
      </div>
     
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
       <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          &nbsp;Use Absolute URLs for instagram,facebook,google and twitter fields.Example: <strong>www.example.com/example</strong>
        </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
              <input class="form-control" name="name" type="text" value="{{$user->name}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">NickName:</label>
            <div class="col-lg-8">
              <input class="form-control" name="pen_name" type="text" value="{{$user->profile->pen_name}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Instagram Link:</label>
            <div class="col-lg-8">
              <input class="form-control" name="insta_link" type="text" value="{{$user->profile->insta_link}}">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Facebook Link:</label>
            <div class="col-lg-8">
              <input class="form-control" name="facebook_link" type="text" value="{{$user->profile->facebook_link}}">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Google Link:</label>
            <div class="col-lg-8">
              <input class="form-control" name="google_link" type="text" value="{{$user->profile->google_link}}">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">twitter Link:</label>
            <div class="col-lg-8">
              <input class="form-control" name="twitter_link" type="text" value="{{$user->profile->twitter_link}}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">About:</label>
            <div class="col-lg-8">
            <textarea name="about" cols="30" rows="10" class="form-control" >{{$user->profile->about}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
              <a href="{{ route('profile.show',$user->username) }}" class="btn btn-default">Cancel</a>
            </div>
          </div>
       
      </div>
       {!!Form::close()!!}
  </div>
@stop
