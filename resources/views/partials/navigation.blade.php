<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Chatty</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if(Auth::check())
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">|</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('profile.index',Auth::user()->username)}}">{{Auth::user()->getNameorUsername()}}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('friends.index')}}">Friends</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('profile.edit',Auth::user()->id)}}">Update</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.signout')}}">Sign Out</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.signup')}}">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('auth.signin')}}">Log In</a>
      </li>
      @endif
    </ul>
    <form class="form-inline my-2 my-lg-0" action="{{route('search.results')}}" role="search">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>