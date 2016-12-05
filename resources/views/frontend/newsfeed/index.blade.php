@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<style>
.datepicker{z-index:1151 !important;}
</style>
<script>
$(document).ready(function(){

  $(".textarea").wysihtml5({
    toolbar: {
      "font-styles": false, // Font styling, e.g. h1, h2, etc.
      "emphasis": true, // Italics, bold, etc.
      "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
      "html": false, // Button which allows you to edit the generated HTML.
      "link": false, // Button to insert a link.
      "image": false, // Button to insert an image.
      "color": false, // Button to change color of font
      "blockquote": true, // Blockquote
    }
  });

  $('#addImage').on('click', function(){
    var id = new Date().getTime();
    var old = $('#workImages').html();
    var newhtml = "<div id='div_"+id+"' class='row'><a class='col-md-11'><span class='file-input btn btn-default btn-block btn-file'><input type='file' name='workimages[]' multiple data-id='"+id+"' class='imgInp'>Зурагаа оруулна уу</span></a><a class='btn btn-default btn-sm icon-only removeimage' data-id='"+id+"' ><i class='fa fa-times'></i></a><div class='col-md-12'><img id='img_"+id+"' style='max-width:100%' src='/frontend/img/icon-edit.png' alt='Зурагаа оруулна уу.' /></div></div>";
    $('#workImages').append(newhtml);

    $(".imgInp").change(function(){
        readURL(this);
    });

    $('.removeimage').on('click', function(){
      var id=$(this).data('id');
      $('#div_'+id).remove();
    });
  });

  function readURL(input) {

      if (input.files && input.files[0]) {
        $(input.files).each(function () {
          var reader = new FileReader();
          reader.readAsDataURL(this);
          reader.onload = function (e) {
              var extention = e.target.result.split('/');
              if('data:image' === extention[0]){
                  $('#img_'+$(input).data('id')).attr('src', e.target.result);
              }else{
                alert("Зөвхөн зурган файл оруулна уу");
                return;
              }
          }
        });
      }
  }
  $('#workfile').on('change', function(){
    var filename = $(this).val().split('\\').pop();
    $('#uploadfilename').html(filename);
  });

  $('.datepicker').datepicker({
     format: 'yyyy-mm-dd'
   }).on('changeDate', function(e){
      $(this).datepicker('hide');
  });

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
                                            <img class="img-circle img-no-padding img-responsive" src="/uploads/profileimage/{{$rUser->profile_image}}" alt="">
                                        @else
                                            <img  class="img-circle img-no-padding img-responsive" src="/frontend/img/Profile/default-avatar.png" alt="">
                                        @endif
                                      </div>
                                  </div>
                                  <div class="col-xs-9">
                                    <a href="{{route('userProfile')}}?id={{$rUser->friend_user_id}}"> {{$rUser->last_name}} {{$rUser->first_name}} </a><br/>
                                     @if( $rUser->status === 1 )
                                     <button data-id="acc_{{$rUser->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
                                     <button data-id="dec_{{$rUser->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
                                     @elseif( $rUser->status === 0 )
                                     <button data-id="can_{{$rUser->friend_user_id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_request')}}</button>
                                     @elseif($rUser->status  === 2)
                                     <button data-id="ded_{{$rUser->friend_user_id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
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

          @include('frontend.newsfeed.groups')
          @include('frontend.group.create_group')
        </div><!-- end right posts -->
      </div>
    </div>
@endsection
