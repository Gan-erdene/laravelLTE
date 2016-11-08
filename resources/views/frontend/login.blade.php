
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">
    <title>Mongolian first freelancer web site</title>

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

  </head>

  <body>

    <nav class="navbar navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
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
                      <h4 class="m-b-0"><span class="icon-text">Нэвтрэх</span></h4>
                      <p class="text-muted">Нэвтэрч орох хэсэг</p>
                    </div>
                    <form action="{{ url('/login') }}" method="get">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="Имэйл хаяг">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" placeholder="Нууц үг">
                        <a href="#" class="pull-xs-right">
                          <small>Нууц үгээ мартсан?</small>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="center">
                        <a href="profile.html" class="btn  btn-azure">
                          Нэвтрэх
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
          <p class="text-muted"> Copyright &copy; EcoNetwork - Бүх эрх хуулиар хамгаалагдсан </p>
        </div>
      </footer>
    </div>
  </body>
</html>
