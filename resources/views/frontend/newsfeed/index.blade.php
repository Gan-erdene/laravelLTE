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
              <h3 class="widget-caption">People You May Know</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                  <div class="content">
                      <ul class="list-unstyled team-members">
                          <li>
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                          <img src="img/Friends/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                     Carlos marthur
                                  </div>

                                  <div class="col-xs-3 text-right">
                                      <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                          <img src="img/Friends/woman-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      Maria gustami
                                  </div>

                                  <div class="col-xs-3 text-right">
                                      <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="row">
                                  <div class="col-xs-3">
                                      <div class="avatar">
                                          <img src="img/Friends/woman-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      Angellina mcblown
                                  </div>

                                  <div class="col-xs-3 text-right">
                                      <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                  </div>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
            </div>
          </div><!-- End people yout may know -->
        </div><!-- end right posts -->
      </div>
    </div>
@endsection
