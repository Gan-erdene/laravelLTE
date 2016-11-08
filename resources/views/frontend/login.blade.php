
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">
    <title>DayDay</title>
    <!-- Bootstrap core CSS -->
    <link href="/frontend/bootstrap.3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/font-awesome.4.6.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/animate.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/timeline.css" rel="stylesheet">
    <link href="/frontend/assets/css/login_register.css" rel="stylesheet">
    <link href="/frontend/assets/css/forms.css" rel="stylesheet">
    <link href="/frontend/assets/css/buttons.css" rel="stylesheet">
    <script src="/frontend/assets/js/jquery.1.11.1.min.js"></script>
    <script src="/frontend/bootstrap.3.3.6/js/bootstrap.min.js"></script>
    <script src="/frontend/assets/js/custom.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button id="menu-toggle" type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar bar1"></span>
            <span class="icon-bar bar2"></span>
            <span class="icon-bar bar3"></span>
          </button>
          <a class="navbar-brand" href="profile.html">Day-Day</a>
        </div>
      </div>
    </nav>
    <div class="wrapper">
      <div class="parallax filter-black">
          <div class="parallax-image"></div>
          <div class="small-info">
            <div class="col-sm-10 col-sm-push-1 col-md-6 col-md-push-3 col-lg-6 col-lg-push-3">
              <div class="card-group animated flipInX">
                <div class="card">
                  <div class="card-block">
                    <div class="center">
                      <h4 class="m-b-0"><span class="icon-text">Login</span></h4>
                      <p class="text-muted">Access your account</p>
                    </div>
                    <form action="index.html" method="get">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password">
                        <a href="#" class="pull-xs-right">
                          <small>Forgot?</small>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="center">
                        <a href="profile.html" class="btn  btn-azure">
                          Login
                        </a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                  <div class="card-block center">
                    <h4 class="m-b-0">
                      <span class="icon-text">Sign Up</span>
                    </h4>
                    <p class="text-muted">Create a new account</p>
                    <form action="index.html" method="get">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name">
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password">
                      </div>
                      <button type="submit" class="btn btn-azure">Register</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

      <footer class="footer">
        <div class="container">
          <p class="text-muted"> Copyright &copy; Company - All rights reserved </p>
        </div>
      </footer>
    </div>
  </body>
</html>
