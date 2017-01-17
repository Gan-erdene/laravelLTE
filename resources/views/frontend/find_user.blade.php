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
                  <td style="width: 20%;">
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
</div>

@endsection
