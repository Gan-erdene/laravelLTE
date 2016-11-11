
@extends('layouts.frontend')
@section('javascripts')
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(function () {
    $('#datepicker').datepicker({
         autoclose: true
       });

 });
</script>
@endsection
@section('content')


    <!-- Begin page content -->
    <div class="container page-content edit-profile">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
      @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- NAV TABS -->
          <ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
            <li class="active"><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Бүртгэл</a></li>
          </ul>
          <!-- END NAV TABS -->
          <div class="tab-content profile-page">
            <!-- PROFILE TAB CONTENT -->
            @if ($message = Session::get('success'))
  		<div class="alert alert-success alert-block">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  		        <strong>{{ $message }}</strong>
  		</div>
  		<img src="/images/{{ Session::get('path') }}">
  		@endif
            <form action="{{ url('/frontend/profile/edit/1') }}"  enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="id" id="{{ Auth::user()->id}}">
              <div class="tab-pane profile active" id="profile-tab">
                <div class="row">
                  <div class="col-md-3">
                    <div class="user-info-left">
                      <img src="/frontend/img/Profile/default-avatar.png" alt="Profile Picture">
                      <h2>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h2>
                      <div class="contact">
                        <p>

                          <span class="file-input btn btn-azure btn-file">
                            Профайл зураг <input type="file" name="profileimage">
                          </span>

                        </p>
                        <p>
                          <span class="file-input btn btn-azure btn-file">
                            Cover Зураг <input type="file" name="coverimage">
                          </span>
                        </p>
                        <ul class="list-inline social">
                          <li><a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
                          <li><a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
                          <li><a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="user-info-right">
                      <div class="basic-info">
                        <h3><i class="fa fa-square"></i> Үндсэн мэдээлэл</h3>
                        <div class="form-group row">
                          <label class="col-sm-1">Регистр</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" id="register" name="register" placeholder="Регистр дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Хүйс</label>
                          <div class="col-md-7">
                            <label>
                              <input type="checkbox" name="gender" value="1">
                              <span class="text">эрэгтэй</span>
                            </label>&nbsp;&nbsp;
                            <label>
                              <input type="checkbox" name="gender" value="2">
                              <span class="text">эмэгтэй</span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">НДД</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" name="ndd" placeholder="Нийгмийн даатгалын дэвтрийн дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">ЭМДД</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" name="emdd" placeholder="Эрүүл мэндийн даатгалын дэвтрийн дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Утас</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" name="phone" placeholder="Утас">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Төрсөн өдөр</label>
                          <div class="col-md-7">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" name="date" placeholder="Төрсөн Он, Сар, Өдөр">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Хаяг</label>
                          <div class="col-md-7">
                            <textarea type="textarea" class="form-control" name="address" placeholder="Оршин суугаа хаяг оруулна уу"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Иргэний үнэмлэх</label>
                          <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-azure btn-file">
                                      File Uploads <input type="file" name="irgenii" multiple="">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly="">
                          </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Хорооны тодорхойлолт</label>
                          <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-azure btn-file">
                                      File Uploads <input type="file" name="khoroo" multiple="">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly="">
                          </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Цагдаагийн тодорхойлолт</label>
                          <div class="col-md-7">
                            <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-azure btn-file">
                                      File Uploads <input type="file" name="tsagdaa" multiple="">
                                  </span>
                              </span>
                              <input type="text" class="form-control" readonly="">
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Хадгалах</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
