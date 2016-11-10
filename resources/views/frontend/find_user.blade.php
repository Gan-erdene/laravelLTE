@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
<script>
  function sendRequest(id){
      $('#u_'+id).prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        userid:id, action:'friend_request', '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
          $('#u_'+data.userid).html("<i class='fa fa-user-times'></i> {{trans('strings.cancel_friend')}}");
          $('#u_'+data.userid).prop('disabled', '');
        }
      });
  }

  function acceptUser(id){
      $('#u_'+id).prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        userid:id, action:'accept', '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
          $('#u_'+data.userid).html("{{trans('strings.friend')}}");
          $('#u_'+data.userid).prop('disabled', '');
          $('#dec_'+data.userid).remove();
        }
      });
  }

  function cancelRequest(id){
      $('#u_'+id).prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        userid:id, action:'cancel', '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
          $('#u_'+data.userid).html("<i class='fa fa-user-plus'></i> {{trans('strings.add_friend')}}");
          $('#u_'+data.userid).prop('disabled', '');
        }
      });
  }

  function declineRequest(id){
      $('#u_'+id).prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        userid:id, action:'decline', '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
            $('#u_'+data.userid).html("{{trans('strings.friend')}}");
        }
      });
  }
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
              <img alt="image" class="img-circle" src="/frontend/img/Friends/guy-1.jpg">
              <h4 class="m-b-xs">{{$item->last_name}}<br>{{$item->first_name}}</h4>

              <div class="font-bold">Graphics designer</div>
            </a>
            <div class="contact-box-footer">
              <div class="m-t-xs btn-group">
                @if( $item->user_status === 0 and $item->user_status !== '')
                <button id="u_{{$item->id}}" onclick="acceptUser('{{$item->id}}')" class="btn btn-xs btn-success"> {{trans('strings.accept_friend')}}</button>
                <button id="dec_{{$item->id}}" onclick="declineRequest('{{$item->id}}')" class="btn btn-xs btn-white"> {{trans('strings.decline_friend')}}</button>
                @elseif($item->friend_status === 0 and $item->friend_status !== '')
                <button id="u_{{$item->id}}" onclick="cancelRequest('{{$item->id}}')" class="btn btn-xs btn-white"><i class="fa fa-user-times"></i> {{trans('strings.cancel_friend')}}</button>
                @elseif($item->user_status === 1 or $item->friend_status === 1)
                <button id="u_{{$item->id}}" class="btn btn-xs btn-white"> {{trans('strings.friend')}}</button>
                @else
                <button id="u_{{$item->id}}" onclick="sendRequest('{{$item->id}}')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> {{trans('strings.add_friend')}}</button>
                @endif
              </div>
            </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
