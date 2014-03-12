
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="http://laravel.com/favicon.png?v=2">

    <title>Remind</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('/css/bootstrap.min.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('/css/form-center.css') }}
   
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      {{ Form::open(array( 'action' => 'AuthController@postRemind', 'class' => 'form-center', 'role' => 'form' )) }}

        @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @elseif(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <h2 class="form-center-heading">Password Reminder</h2>
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control unique', 'placeholder' => 'Email address') )}}
        {{ $errors->first('email', '<p class="text-danger">:message</p>') }}
        {{ Form::submit('Send Reminder', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        <span class="pull-right">
          <a href="/login">Login</a>
        </span>
      {{ Form::close() }}

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
