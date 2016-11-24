@extends('layouts.frontend')
@section('javascripts')
 <link href="/frontend/assets/css/friends.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row page-content">
      <div class="col-md-8 col-md-offset-2">

        <div class="row">
          <div class="col-md-12">
            <div class="cover profile">
              <div class="wrapper">
                @if ($user_about->coverName)
                <div class="image">
                  <img src="\uploads\coverimage\{{$user_about->coverName}}" class="show-in-modal" alt="people">
                </div>
                  @else
                   <div class="image">
                     <img src="/frontend/img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                   </div>
                  @endif
                @include('frontend.home.cover_right_friends',['cover_right_friend'=>$cover_right_friend])
              </div>
              <div class="cover-info">
                @if( $user_about->profile_image)
                <div class="avatar">
                    <img src="/uploads/profileimage/{{ $user_about->profile_image}}" alt="people">
                </div>
                @else
                <div class="avatar">
                    <img src="/frontend/img/Profile/default-avatar.png" alt="people">
                </div>
                @endif

                <div class="name"><a href="#">{{ $user_about->first_name }} {{ $user_about->last_name }}</a></div>
                <ul class="cover-nav">
                  <li><a href="{{ url('/frontend/userabout/?id='.$user_about->id)  }}"><i class="fa fa-fw fa-user"></i> Миний тухай</a></li>
                  <li class="active" id='friendView'><a href="{{ url('/frontend/userFriendsList/?id='.$user_about->id)}}"><i class="fa fa-fw fa-users"></i> Найзууд</a></li>
                  <li><a href="{{ url('frontend/userPhotos/?id='.$user_about->id)}}"><i class="fa fa-fw fa-image"></i> Зураг</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>


      <div class="row">
        @foreach($friends as $friend)
          <div class="col-md-3">
              <div class="contact-box center-version">
                <a href="#">
                  @if(isset($friend->friend->profile_image))
                  <img alt="image" class="img-circle" src="/uploads/profileimage/{{$friend->friend->profile_image}}">
                  @else
                    <img alt="image" class="img-circle" src="/frontend/img/Profile/default-avatar.png" alt="people">
                  @endif

                  <h3 class="m-b-xs"><strong>{{$friend->friend->first_name}}</strong></h3>
                  @if($friend->friend->work)
                  <div class="font-bold">{{$friend->friend->work}}</div>
                  @else
                  <div class="font-bold">
                    Ажилгүй
                  </div>
                  @endif
                </a>
                <div class="contact-box-footer">
                  <div class="m-t-xs btn-group">
                    <a href="messages1.html" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i>Send Messages</a>
                    <a class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Follow</a>
                  </div>
                </div>
              </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body text-centers">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

@endsection
