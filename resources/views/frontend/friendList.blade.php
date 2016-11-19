@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/profile2.css" rel="stylesheet">
<script>
  $(document).on('click', '.finduser', function(){
      var  btn = $(this);
      btn.prop('disabled', 'disabled');
      $.post("{{route('frontendFindUserAction')}}", {
        action:btn.data('id'), '_token':"{{ csrf_token() }}"
      },function(data){
        if(data.status){
          btn.data('id', data.dataid);
          btn.html(data.btntext);
          btn.prop('disabled', '');
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
      <ul class=" widget-users row">
      @foreach($friends as $item)
            <li class="col-md-4">
              <div class="img">
                @if($item->profile_image)
                <img src="/uploads/profileimage/{{$item->profile_image}}" alt="">
                @else
                <img src="/frontend/img/Profile/default-avatar.png" alt="">
                @endif
              </div>
              <div class="details">
                <div class="name">
                  <a href="{{ url('/frontend/userprofile/?id='.$item->id) }}">{{$item->first_name}} {{$item->last_name}}</a>
                </div>
                <div class="time">
                  <i class="fa fa-clock-o"></i> Last online: 5 minutes ago
                </div>
                <div class="m-t-xs btn-group">
                  <button data-id="rem_{{$item->listid}}" class="btn btn-xs btn-white finduser"> {{trans('strings.remove_friend')}} </button>
                </div>
              </div>
            </li>
      @endforeach
    </ul>
    </div>
</div>
@endsection
