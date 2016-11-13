@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
@endsection
@section('content')
<div class="container page-content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
                  <form action="{{ url('/frontend/file/add')}}" enctype="multipart/form-data" method="POST">
                      {{ csrf_field() }}
                        <input type="hidden" name="id" id="{{ Auth::user()->id}}">
                  <ul class="nav nav-pills nav-stacked">
                      <li class="active">
                        <a>Иргэний үнэмлэх хуулбар &nbsp;<span class="file-input btn btn-azure btn-file">
                                  Upload   <input type="file" id="irgenii" name="irgenii" multiple="">
                          </span></a>
                        </li>
                        <li class="active">
                        <a>Хорооны тодорхойлолт &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="file-input btn btn-azure btn-file">
                              Upload  <input type="file" id="khoroo" name="khoroo" multiple="">
                          </span></a>
                        </li>
                        <li class="active">
                        <a>Цагдаагийн тодорхойлолт&nbsp;<span class="file-input btn btn-azure btn-file">
                              Upload  <input type="file" name="tsagdaa" name="tsagdaa" multiple="">
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
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
              @endif
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <span class="username">Иргэний үнэмлэх хуулбар</span>
                  </div>
                </div>
                <div class="box-body" style="display: block;">
                  <img class="img-responsive pad show-in-modal" src="/uploads/irgenii/{{$user->irgenii}}">
                </div>
              </div>
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <span class="username">Хорооны тодорхойлолт</span>
                  </div>
                </div>
                <img class="img-responsive pad show-in-modal" src="/uploads/khoroo/{{$user->khoroo}}">
                <div class="box-body" style="display: block;">
                </div>
              </div>
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <span class="username">Цагдаагийн тодорхойлолт</span>
                  </div>
                </div>
                <img class="img-responsive pad show-in-modal" src="/uploads/tsagdaa/{{$user->tsagdaa}}">
                <div class="box-body" style="display: block;">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection
