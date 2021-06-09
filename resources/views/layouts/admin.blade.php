<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{$title ?? ''}}</title>
  </head>
  <body>

@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Newsletter Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Users Management
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{url('usergroup')}}">User Group</a></li>
            <li><a class="dropdown-item" href="{{url('customers')}}">Users</a></li>
            <li><a class="dropdown-item" href="{{url('customersbulk')}}">User Bulk Upload</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('newsletter')}}">Newsletters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('jobs')}}">Jobs and Queues</a>
        </li>
      </ul>
      <span class="navbar-text">
       {{Auth::user()->name}}
       <a href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
      </span>
    </div>
  </div>
</nav>    
@endauth

      <div class="container">

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
          <strong>Yes!</strong> {{session()->get('success')}}.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif
@if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
          <strong>Oh no!</strong> {{session()->get('error')}}.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger mt-2">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
        @endif
  @yield('content')
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/3iq8nga2ajrxawbbyax3uloa0usiuvnfc5y7goykmsf8zu3e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
      tinymce.init({
        selector: '#mytextarea1'
      });
    </script>
    <script>
      $('#template_id1').on('change', function() {
        tinymce.activeEditor.setContent(this.value);
});
    </script>
  </body>
</html>