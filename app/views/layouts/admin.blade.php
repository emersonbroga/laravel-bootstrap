<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Styles -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic') }}
    {{ HTML::style('css/styles.css') }}

    @section('styles')
    @show
    
    <!--[if lt IE 9]>
        {{ HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js') }}
    <![endif]-->
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('admin.dashboard') }}">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ URL::route('admin.users.index') }}">Users</a></li>
            <li><a href="#">{{ Auth::user()->email }}</a></li>
            <li><a href="{{ URL::route('auth.logout') }}">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>


    <div id="main" class="container shadow">
        <div class="row dashboard-main-row">

        @section('content')
        @show
        </div>
    </div>
    
    <!-- Scripts -->
    {{ HTML::script('http://code.jquery.com/jquery-latest.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    
    {{ HTML::script('js/scripts.js') }}

    @section('scripts')
    @show
</body>
</html>    