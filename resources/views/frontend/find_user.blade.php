@extends('layouts.frontend')
@section('javascripts')
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
<link href="/css/simply-tag.css" rel="stylesheet">
<script src="/js/simply-tag.js"></script>
<script>
  @include('frontend.js.friend_request')
  $(function(){
    $('#test').simplyTag(
    {
        forMultiple: true,
        dataSource: JSON.parse('[{ "key": 1, "value": "Value1" }, { "key": 2, "value": "value2" }, { "key": 3, "value": "value3" }]')
    });
  });
</script>
@endsection
@section('content')
<div class="row page-content">
  <div class="col-md-7 col-md-offset-1">
    <div class="row">
        <div class="col">
          <div class="widget">
            <div class="table-responsive">
            <table class="table user-list">
              <tbody>
                @foreach($users as $item)
                <tr>
                  <td>
                    @if($item->friend->profile_image)
                        <img class="img-circle" src="/uploads/profileimage/{{$item->friend->profile_image}}" alt="">
                    @else
                        <img  class="img-circle" src="/frontend/img/Profile/default-avatar.png" alt="">
                    @endif
                    <a href="{{route('userProfile')}}?id={{$item->friend->id}}" class="user-link">{{$item->friend->last_name}} {{$item->friend->first_name}}</a>
                    @if(App\Helper\DatabaseHelper::canSee($item->friend->id, 'config_work'))
                    <span class="user-subhead">{{$item->friend->work}}</span>
                    @else
                    <i>----</i>
                    @endif
                  </td>
                  <td>
                    {{str_limit($item->friend->ur_zadvar, 100)}}
                  </td>
                  <td>
                    <div class="m-t-xs btn-group">
                      @if( $item->status === 1 )
                      <button data-id="acc_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
                      <button data-id="dec_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
                      @elseif( $item->status === 0 )
                      <button data-id="can_{{$item->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_request')}}</button>
                      @elseif($item->status  === 2)
                      <button data-id="ded_{{$item->friend_user_id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                      @else
                      <button data-id="add_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.add_friend')}}</button>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            </div>
        </div>
      </div>
    <div>
      {{ $users->links() }}
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget">
      <div class="widget-header">
        <h3 class="widget-caption"> Та сонирхолоор хайж үзэхүү </h3>
      </div>
      <div class="widget-body bordered-top bordered-sky">
        <div class="row">
          <div class="col-xs-12">
            <div class="container">
              <div id='test'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
