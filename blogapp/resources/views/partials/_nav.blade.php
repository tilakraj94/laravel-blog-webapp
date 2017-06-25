 <!-- Default Bootstrap Navbar -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a  href="/"><img id="logo" src="/tempx2.png" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{Request::is('/')?'active':''}}"><a href="{{ route('home') }}">Home</a></li>
            <li class="{{ Request::is('blog') ? "active" : "" }}"><a href="{{ route('blog.index')}}">Blog</a></li>
            <li class="{{Request::is('about')?'active':''}}"><a href="{{ route('about') }}">About</a></li>
            <li class="{{Request::is('contact')?'active':''}}"><a href="{{ route('contact') }}">Contact</a></li>
          </ul>

          {!!Form::open(['route'=>'logout','method'=>'POST','id'=>'LogOut-form'])!!}
          {!!Form::close()!!}
          <ul class="nav navbar-nav navbar-right">
          <li><a href="https://foodquo.com">FoodQuo?</a></li>
          @if(Auth::check())
            <li class="dropdown">

              <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Howdy!</strong>  {{Auth::user()->name}} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                 <li><a href="{{ route('posts.index') }}">Posts</a></li>
                 <li><a href="{{ route('categories.index') }}">Categories</a></li>
                 <li><a href="{{ route('tags.index') }}">Tags</a></li>
                 <li><a href="{{ route('profile.show',Auth::user()->username)}}">View Profile</a></li>
                 <li><a href="{{ route('profile.edit',Auth::user()->username) }}">Edit Profile</a></li>
                 <li><a href="{{ route('changepass')}}">Change Password</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#" id="LogOut-link">LogOut</a></li>
              </ul>
            </li>
            @else
            <li><a href="{{route('login')}}">Login</a></li>
            @endif
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
