@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
<script>
  @include('frontend.js.friend_request')
</script>
@endsection
@section('content')
<div class="row page-content">
  <div class="col-md-8 col-md-offset-2">
    <div class="row">
      @foreach($users as $item)
      <div class="col-md-3">
          <div class="contact-box center-version">
            <a href="#">
              @if($item->profile_image)
                  <img class="img-circle" src="/uploads/profileimage/{{$item->profile_image}}" alt="">
              @else
                  <img  class="img-circle" src="/frontend/img/Profile/default-avatar.png" alt="">
              @endif
              <h4 class="m-b-xs">{{$item->last_name}}<br>{{$item->first_name}}</h4>

              <div class="font-bold">{{$item->work}}</div>
            </a>
            <div class="contact-box-footer">
              <div class="m-t-xs btn-group">
                @if( $item->status === 1 )
                <button data-id="acc_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
                <button data-id="dec_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
                @elseif( $item->status === 0 )
                <button data-id="can_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_request')}}</button>
                @elseif($item->status  === 2 or $item->status === 3 )
                <button data-id="ded_{{$item->friend_user_id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                @else
                <button data-id="add_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.add_friend')}}</button>
                @endif
              </div>
            </div>
          </div>
      </div>
      @endforeach
    </div>
    <div>
      @if(sizeof($users) === 16)
      <ul class="pagination">
          <li >
            @if($page <= 1)
            <a style="background:#e9eaed" class="active" aria-label="Previous">
                <span aria-hidden="true">«</span>
            </a>
            @else
              <a href="/frontend/friend/find?page={{$page <=1 ? 1 : $page-1}}" aria-label="Previous">
                  <span aria-hidden="true">«</span>
              </a>
              @endif
          </li>
          <li>
              <a href="/frontend/friend/find?page={{$page+1}}" aria-label="Next">
                  <span aria-hidden="true">»</span>
              </a>
          </li>
      </ul>
      @endif
    </div>
  </div>
</div>

@endsection
