@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<script>
$(document).ready(function(){
  @if($m_s)
    $('#m_s_{{$m_s}}').addClass('active');
  @elseif($m_c)
    $('#m_c_{{$m_c}}').addClass('active');
  @elseif($saved)
    $('#savedwork').addClass('active');
  @endif

  $.post('{{route("newsfeedAction")}}', {
    action:
      @if($saved) 'post_saved'
      @elseif($m_c) 'post_category', value:"{{$m_c}}"
      @elseif($m_s) 'post_section', value:"{{$m_s}}"
      @else 'post_work' @endif , _token:"{{csrf_token()}}"
  }, function( data ){
    $('#posts').html( data.html );
  });

  @include('frontend.js.like')
  @include('frontend.js.getcategory')

  $(document).on('click', '#btnCommentSend', function(){
    commentSend($(this).data('id'));
  });

  $(document).on('keypress', '.comment', function (e) {
         if(e.which === 13){
            commentSend($(this).data('id'));
         }
   });

  function commentSend(workid){
    if($('#comm_'+workid).val().trim().length === 0){
      alert("Хоосон сэтгэгдэл игээх боломжгүй");
      return;
    }
    var input = $('#comm_'+workid);
    var comment = input.val();
    input.val("");
    input.prop('disabled', 'disabled');
    $.post("{{route('commentAction')}}", {
      action:'add_post', workid:workid, _token:"{{csrf_token()}}", comment:comment
    }, function(data){
      $('#coms_'+data.workid).html(data.comments);
      input.prop('disabled', '');
    })

  }

  @include('frontend.js.friend_request')
});
</script>
@endsection
@section('content')
<div class="container page-content ">
      <div class="row">
        <!-- left links -->
        @include('frontend.newsfeed.leftmenu')
        @include('frontend.newsfeed.timeline')

        <!-- right posts -->
        <div class="col-md-3">
          <!-- People You May Know -->
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Та эдгээр хүмүүсийг мэдэх үү</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                  <div class="content">
                      <ul class="list-unstyled team-members">
                        @foreach($right_users as $rUser)
                          <li>
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                        @if($rUser->profile_image)
                                            <img class="img-circle img-no-padding img-responsive" src="/uploads/profileimage/{{$item->profile_image}}" alt="">
                                        @else
                                            <img  class="img-circle img-no-padding img-responsive" src="/frontend/img/Profile/default-avatar.png" alt="">
                                        @endif
                                      </div>
                                  </div>
                                  <div class="col-xs-9">
                                     {{$rUser->last_name}} {{$rUser->first_name}}<br/>
                                     @if( $rUser->user_status === 0 )
                                     <button data-id="acc_{{$rUser->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
                                     <button data-id="dec_{{$rUser->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
                                     @elseif($rUser->friend_status === 0 )
                                     <button data-id="can_{{$rUser->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_friend')}}</button>
                                     @elseif($rUser->user_status === 1 or $rUser->friend_status === 1)
                                     <button data-id="fri_{{$rUser->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.friend')}}</button>
                                     @elseif($rUser->user_status === 2 )
                                     <button data-id="ded_{{$rUser->id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                                     @elseif($rUser->friend_status === 2 )
                                     <button data-id="ded_{{$rUser->id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
                                     @else
                                     <button data-id="add_{{$rUser->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.add_friend')}}</button>
                                     @endif
                                  </div>
                              </div>
                          </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
            </div>
          </div><!-- End people yout may know -->
        </div><!-- end right posts -->
      </div>
    </div>
@endsection
