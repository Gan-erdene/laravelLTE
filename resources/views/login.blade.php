
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Админ Нэвтрэх Хуудас</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../admin/bootstrap/css/bootstrap.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="../admin/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../admin/plugins/iCheck/square/blue.css">


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../admin/index2.html"><b>Админ хуудас</a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Нэвттэрч орох</p>

    <form action="../admin/index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Мэйл хаяг">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Нууц үг">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Нууц үг хадгалах
            </label>
          </div>
        </div>

        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Нэвтрэх</button>
        </div>

      </div>
    </form>
<!--
    <div style="display:none" class="social-auth-links text-center">
      <p>- Эсвэл -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->


    <!-- <a href="#">Нууц үг сэргээх</a><br> -->
    <a href="/frontend/index" class="text-center">Шинээр бүртгүүлэх</a>

  </div>

</div>

<script src="../admin/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="../admin/bootstrap/js/bootstrap.min.js"></script>

<script src="../admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>
</body>
</html>
