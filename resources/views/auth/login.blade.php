
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
  <p class="login-box-msg">Нэвтэрч орох</p>

  <form class="form-horizontal" role="form" method="POST" action="{{ url('/backend/login') }}">
      {{ csrf_field() }}
          <div class="form-group has-feedback{{ $errors->has('email_address') ? ' has-error' : '' }}">
      <input id="email_address" type="email" class="form-control" placeholder="Мэйл хаяг" name="email_address" value="{{ old('email_address') }}" required autofocus>
    </div>
    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}" >
      <input id="password" type="password" class="form-control" placeholder="Нууц үг" name="password" required>
      @if ($errors->has('password'))
            <div class="box-body">
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Санамж!</h4>
                  {{ $errors->first('password') }}
                </div>
              </div>
      @elseif ($errors->has('email_address'))
        <div class="box-body">
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Санамж!</h4>
            {{ $errors->first('email_address') }}
          </div>
        </div>
      @endif

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
  <!-- <a href="{{ url('/password/reset') }}">Нууц үг сэргээх</a><br> -->
  <a href="{{ url('/register') }}" class="text-center">Шинээр бүртгүүлэх</a>

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
