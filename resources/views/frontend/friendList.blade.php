@extends('layouts.frontend')
@section('javascripts')
 <link href="/frontend/assets/css/friends.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row page-content">
      <div class="col-md-8 col-md-offset-2">
        @include('frontend.user.cover', ['user'=>$user_about])
      <div class="row">
        @foreach($friends as $friend)
          <div class="col-md-3">
              <div class="contact-box center-version">
                <a href="{{route('userProfile')}}?id={{$friend->friend_user_id}}">
                  <img alt="image" class="img-circle" src="{{$friend->friend->getAvatar()}}">
                  <h3 class="m-b-xs"<strong>{{$friend->friend->first_name}}</strong></h3>
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
                    <a href="messages1.html" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i>Зурвас илгээх</a>
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
