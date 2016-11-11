@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
<script>

  $(document).on('click', '.finduser', function(){
      var  btn = $(this);
      btn.prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        action:btn.data('id'), '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
          console.log(data);
          btn.data('id', data.dataid);
          btn.html(data.btntext);
          btn.prop('disabled', '');
          console.log(btn.data('id'));
        }else{
          btn.prop('disabled', '');
          alert(data.message);
        }
      });
  });

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
                @if( $item->user_status === 0 )
                <button data-id="acc_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
                <button data-id="dec_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
                @elseif($item->friend_status === 0 )
                <button data-id="can_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_friend')}}</button>
                @elseif($item->user_status === 1 or $item->friend_status === 1)
                <button data-id="fri_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.friend')}}</button>
                @elseif($item->user_status === 2 )
                <button data-id="ded_{{$item->id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                @elseif($item->friend_status === 2 )
                <button data-id="ded_{{$item->id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                @else
                <button data-id="add_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.add_friend')}}</button>
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
