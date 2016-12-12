
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/frontend/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/frontend/img/favicon.ico" type="image/x-icon">
    <title>Ажилсаг залуусын сошиал сүлжээ</title>
    <link href="/frontend/bootstrap.3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/font-awesome.4.6.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/animate.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/timeline.css" rel="stylesheet">
    <link href="/frontend/assets/css/cover.css" rel="stylesheet">
    <link href="/frontend/assets/css/forms.css" rel="stylesheet">
    <link href="/frontend/assets/css/edit_profile.css" rel="stylesheet">
    <link href="/frontend/assets/css/buttons.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    @yield('css')
    <script src="/frontend/assets/js/jquery.1.11.1.min.js"></script>
    <script src="/frontend/bootstrap.3.3.6/js/bootstrap.min.js"></script>
    <script src="/frontend/assets/js/custom.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    @yield('javascripts')
  </head>

  <body class="animated fadeIn">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-white navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/start"><b><img src="/frontend/img/logo.png" /></b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="actives"><a href="{{route('frontendHome')}}"><i class="fa fa-user"></i> Нэвтрэх &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fa fa-user-plus"></i> {{trans('strings.signup')}} </a></li>
          </ul>
        </div>
      </div>
    </nav>
    @yield('content')
    <!-- Online users sidebar content-->
    <div class="chat-sidebar">
      <div class="list-group text-left">
        <p class="text-center visible-xs"><a href="#" class="hide-chat btn btn-success">Hide</a></p>
        <p class="text-center chat-title">Online users</p>
        <div id="friendList">
        </div>
      </div>
    </div><!-- Online users sidebar content-->
    <!-- Modal -->

    @include('layouts.frontend_footer')
  </body>
</html>
