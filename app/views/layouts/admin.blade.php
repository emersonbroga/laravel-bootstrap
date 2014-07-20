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
    {{ HTML::style('css/admin.css') }}

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
          <a class="navbar-brand" href="{{ URL::route('admin.dashboard') }}">Project</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ URL::route('admin.users.index') }}">Users</a></li>
            <li><a href="{{ URL::route('admin.users.show', Auth::user()->id) }}">{{ Auth::user()->email }}</a></li>
            <li><a href="{{ URL::route('auth.logout') }}">Logout</a></li>
          </ul>
         <!--  <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->

          <ul class="nav navbar-nav navbar-left">
            <li><a href="#1">Section #1</a></li>
             <li><a href="#2">Section #2</a></li>

        </ul>


        </div>
      </div>
    </div>

    @if(Session::has('error'))
        <div class="alert alert-danger fixed" role="alert"> 
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{{ Session::get('error') }}}
        </div>
    @elseif(Session::has('success'))
        <div class="alert alert-success fixed" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            {{{ Session::get('success') }}}
        </div>
    @endif



    <div id="main" class="container shadow">
        <div class="row dashboard-main-row">

        @section('content')
        @show
        </div>

        <div id="push"></div>
    </div>

    <div id="footer">
        <div class="container">

            <div class="row">
                <span class="muted"> {{ date('Y') }} - Project</span>
                <a href="{{ route('lang',['pt-br']) }}" class="pull-right" title="Traduzir para Portugês"><img src="{{ asset('images/blank.gif') }}" alt="Portugês" class="flag flag-br"></span></a> &nbsp;
                <a href="{{ route('lang',['en']) }}" class="pull-right" title="Translate to English" ><img src="{{ asset('images/blank.gif') }}" alt="English" class="flag flag-us"></span></a> &nbsp;
            </div>    
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