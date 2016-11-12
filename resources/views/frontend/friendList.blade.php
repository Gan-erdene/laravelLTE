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
      <div class="row">
      @foreach($friends as $item)
          <div class="col-md-3">
              <div class="contact-box center-version">
                <a href="#">
                  <img alt="image" class="img-circle" src="img/Friends/guy-1.jpg">
                  <h4 class="m-b-xs">{{$item->first_name}}<br/>{{$item->last_name}}</h4>

                  <div class="font-bold">Graphics designer</div>
                </a>
                <div class="contact-box-footer">
                  <div class="m-t-xs btn-group">
                    <button data-id="rem_{{$item->listid}}" class="btn btn-xs btn-white finduser"> {{trans('strings.remove_friend')}} </button>
                  </div>
                </div>
              </div>
          </div>
      @endforeach
        </div>
    </div>
</div>
@endsection
