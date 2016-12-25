
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
  

    <script>
          window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
          ]); ?>
    </script>
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
          <a class="navbar-brand" href=""><img src="/frontend/img/logo_no_bg.png"></a>
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
                      @include('status')

                    <form method="POST" action="{{ url('/frontend/login') }}">
                      {{ csrf_field() }}
                        <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Имэйл хаяг">{{ $errors->first('email_address') }}
                      </div>
                      <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Нууц үг">{{ $errors->first('password') }}
                        <a href="#" class="pull-xs-right">
                          <small>Нууц үгээ мартсан?</small>
                        </a>
                        <div class="clearfix"></div>
                      </div>
                      <div class="center">
                        <button type="submit" class="btn  btn-azure btn-block">Нэвтрэх</button>


                      </div>
                      <div class="social-auth-links text-center">
                        <a href="" class="pull-xs-right"><small> - Эсвэл - </small></a>
                        <a href="/frontend/facebook" class="btn btn-azure btn-block"><i class="fa fa-facebook"></i>Facebook эрхээр нэвтрэх </a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card">
                  @include('frontend.signup')
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
