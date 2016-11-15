
@extends('layouts.frontend')
@section('javascripts')
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(function () {
    @if($s === 'c')
      $('#cate').addClass("active");
      $('#category-tab').addClass("active");
    @elseif($s === 'p')
        $('#ava').addClass("active");
        $('#avatar-tab').addClass("active");
    @else
      $('#prof').addClass("active");
      $('#profile-tab').addClass("active");
    @endif
    $('#datepicker').datepicker({
         format: 'yyyy-mm-dd'
       });
       @if(isset($user))
        $('#lastname').val("{{$user->last_name}}");
        $('#firstname').val("{{$user->first_name}}");
        $('#email').val("{{$user->email_address}}");
        $('#register').val("{{$user->register}}");
        $('#work').val("{{$user->work}}");
        $('#phone').val("{{$user->phone}}");
        $('#gender_{{$user->gender}}').attr('checked', true);
        $('#ndd').val("{{$user->ndd}}");
        $('#emdd').val("{{$user->emdd}}");
        $('#datepicker').val("{{$user->birthday}}");
        $('#address').val("{{$user->address}}");

       @endif
   $(document).on('change', '.selectsection', function(){
     if(this.checked){
         $.post("{{route('workAction')}}", {'_token':"{{ csrf_token() }}",
           action:'category', section_id:this.value
         }, function(data){
             $('#cat_container').append(data.html);
         });
     }else{
       $('.sec_'+this.value).remove();
     }
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
            <li id="prof" class=""><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Бүртгэл</a></li>
            <li id="ava" class=""><a href="#avatar-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Профайл зураг</a></li>
            <li id="cate" class=""><a href="#category-tab" data-toggle="tab" aria-expanded="true"> Сонирходог сэдэв</a></li>
          </ul>
          <!-- END NAV TABS -->
          <div class="tab-content profile-page">
            <!-- PROFILE TAB CONTENT -->
            @if ($message = Session::get('success'))
        		<div class="alert alert-success alert-block">
        			<button type="button" class="close" data-dismiss="alert">×</button>
        		        <strong>{{ $message }}</strong>
        		</div>

        		@endif

              <div class="tab-pane profile" id="profile-tab">
                <form action="{{ url('/frontend/profile/edit') }}"  enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" id="{{ Auth::user()->id}}">
                <div class="row">
                  <div class="col-md-3">
                    <div class="user-info-left">
                      <img src="/uploads/profileimage/{{$user->profile_image}}" alt="Profile Picture">
                      <h2>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h2>
                      <div class="contact">

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
                          <label class="col-sm-1">Овог</label>
                          <div class="col-md-7">
                            <input id="lastname" type="text" class="form-control"  name="lastname" placeholder="Овог">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Нэр</label>
                          <div class="col-md-7">
                            <input id="firstname" type="text" class="form-control"  name="firstname" placeholder="Нэр">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Мэйл</label>
                          <div class="col-md-7">
                            <input id="email" type="text" class="form-control"  name="email" placeholder="Мэйл">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Регистр</label>
                          <div class="col-md-7">
                            <input id="register" type="text" class="form-control"  name="register" placeholder="Регистр дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Хүйс</label>
                          <div class="col-md-7">

                            <label>
                              <input type="radio" id="gender_1" name="gender" value="1">
                              <span class="text">эрэгтэй</span>

                            </label>&nbsp;&nbsp;
                            <label>
                              <input type="radio" id="gender_2" name="gender" value="2">
                              <span class="text">эмэгтэй</span>

                            </label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Ажил</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" id="work" name="work" placeholder="Ажил ">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">НДД</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" id="ndd" name="ndd" placeholder="Нийгмийн даатгалын дэвтрийн дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">ЭМДД</label>
                          <div class="col-md-7">
                            <input type="text" class="form-control" id="emdd" name="emdd" placeholder="Эрүүл мэндийн даатгалын дэвтрийн дугаар">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Утас</label>
                          <div class="col-md-7">
                            <input id="phone" type="text" class="form-control" name="phone" placeholder="Утас">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Төрсөн өдөр</label>
                          <div class="col-md-7">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" name="birthday" placeholder="Төрсөн Он, Сар, Өдөр">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-1">Хаяг</label>
                          <div class="col-md-7">
                            <textarea type="textarea" class="form-control" id="address" name="address" placeholder="Оршин суугаа хаяг оруулна уу"></textarea>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Хадгалах</button></p>
                </form>
              </div>

              <div class="tab-pane avatar" id="avatar-tab">

                  <div class="row">
                    <div class="profile-nav col-md-4">
                      <div class="panel">
                          <div class="user-heading round">
                            @if($user->profile_image)
                              <a href="#">
                                  <img src="/uploads/profileimage/{{\Auth::user()->profile_image}}" alt="">
                              </a>
                              @else
                              <a href="#">
                                  <img src="/frontend/img/Profile/default-avatar.png" alt="">
                              </a>
                              @endif
                              <h1>{{\Auth::user()->last_name}} {{\Auth::user()->first_name}}</h1>
                              <p>{{\Auth::user()->email_address}}</p>
                          </div>
                          <form action="{{ url('/frontend/profile/cover')}}" enctype="multipart/form-data" method="POST">
                              {{ csrf_field() }}
                                <input type="hidden" name="id" id="{{ Auth::user()->id}}">
                               <ul class="nav nav-pills nav-stacked">
                              <li class="active">
                                <a>Профайл зураг оруулах &nbsp;&nbsp;&nbsp;<span class="file-input btn btn-azure btn-file">
                                          Upload   <input type="file" id="profileimage" name="profileimage" multiple="">
                                  </span></a>
                                </li>
                                <li class="active">
                                <a>Cover зураг оруулах &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="file-input btn btn-azure btn-file">
                                      Upload  <input type="file" id="coverName" name="coverName" multiple="">
                                  </span></a>
                                </li>

                                <li>
                                <a class="text-right"><button type="submit" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Хадгалах</button></a>
                              </li>
                          </ul>

                        </form>
                      </div>
                    </div>
                    <div class="profile-info col-md-8">
                      <div class="box box-widget">
                        <div class="box-header with-border">
                          <div class="user-block">
                            <span class="username">Cover зураг</span>
                          </div>
                        </div>
                        <img class="img-responsive pad show-in-modal" src="/uploads/coverimage/{{$user->coverName}}">
                        <div class="box-body" style="display: block;">
                        </div>
                      </div>
                    </div>
                  </div>


              </div>
              <div class="tab-pane category" id="category-tab">
                @include('status')
                <form action="/home/section/action" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="action" value="user_cat_sec">
                  <div class="row">
                    @include('section.sectionItem')
                  </div><hr/>
                  <div class="row" id="cat_container">
                    @include('category.categoryItem')
                  </div><hr/>
                  <div class="row text-center">
                      <button class="btn btn-default purple"><i class="fa fa-save"></i> {{trans('strings.save')}}</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
