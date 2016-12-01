@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/group.css" rel="stylesheet">
<script>
$(document).on('click', '.groupuser', function(){
    var btn = $(this);
    btn.prop('disabled', 'disabled');
    $.post("{{route('groupAction')}}", {
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
$(document).on('click', '.acceptuser', function(){
    var btn = $(this);
    btn.prop('disabled', 'disabled');
    $.post("{{route('groupAction')}}", {
      action:btn.data('id'), '_token':"{{ csrf_token() }}"
    },function(data){
      if(data.status){
          btn.remove();
      }else{
        btn.prop('disabled', '');
        alert(data.message);
      }
    });
});
</script>
<script>
$(document).on('click', '.group_like',function(event){
  event.preventDefault();
  var btn = $(this);
  var postId = btn.data("id");

btn.prop('disabled', 'disabled');
  $.post("{{ url('/frontend/group/like') }}", { postId: postId, _token: '{{  csrf_token() }}' }, function(data){
      if(data.status === 'success'){
        console.log(data.message);
        console.log(btn);
        btn.html(data.message);
        btn.prop('disabled', '');
        $('#like_' + postId).html(data.likecount);
      }
  });
});
</script>
@endsection
@section('content')
<div class="container page-content">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-md-12">
              <div class="widget">
                <div class="cover-photo">
                  <div class="group-timeline-img">
                      <img src="/frontend/img/Cover/bootsrap-cover2.png" alt="">
                  </div>
                  <div class="group-name">
                      <h2><a href="#">{{$group->group_name}}</a></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- group posts -->
            <div class="col-md-7">
              @if($groupuser)
              @if($groupuser->status === 2 or $groupuser->status === 1)

              <div class="box profile-info n-border-top">
                <form action="{{ url('/frontend/group/post') }}"  enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="group_id" value="{{$group->id}}">
                    <textarea class="form-control input-lg p-text-area" id="group_text" name="group_text" rows="2" placeholder="Юу бодож байна?"></textarea>

                <div class="box-footer box-form">
                  <button type="submit" class="btn btn-azure pull-right">Нийтлэх</button>
                  <ul class="nav nav-pills">

                    <li><a onclick="document.getElementById('group_upload').click(); return true"><i class="fa fa-image"> </i><input type="file" id="group_upload" name="group_upload" style="visibility: hidden; width: 1px; height: 1px" multiple /></a></li>
                     <li><a href="#"><i class=" fa fa-film"></i></a></li>
                  </ul>
                </div>
              </div>
              </form>
              @endif
              @else

              @endif
            @foreach($post_lists as $list)
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    @if($list->postUser->profile_image)

                        <img class="img-circle" src="/uploads/profileimage/{{$list->postUser->profile_image}}" alt="User Image">


                    @else

                        <img class="img-circle"  src="/frontend/img/Profile/default-avatar.png" alt="User Image">

                    @endif

                    <span class="username"><a href="#">{{$list->postUser->first_name}}{{$list->postUser->last_name}}</a></span>
                    <span class="description">Нийтэлсэн: {{date('Y.m.d H:i:s', strtotime($list->created_at))}}</span>
                  </div>
                </div>

                <div class="box-body" style="display: block;">
                  <p>
                      {{$list->body}}
                  </p>
                  <p>
                  @if($list->image)
                   <img class="img-responsive show-in-modal" src="/uploads/grouppost/{{$list->image}}" alt="Photo">
                  @else
                  @endif
                  <p>
                  <!-- <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button> -->
                  <button type="button" data-id="{{$list->id}}" class="btn btn-default btn-xs group_like"><i class="fa fa-thumbs-o-up"></i>{{ $list->likes->where('post_id',$list->id)->first() ? 'unlike' : 'like'   }}</button>
                  <span class="pull-right text-muted"><span id="like_{{$list->id}}"></span>{{$list->likecount}} likes</span>
                </div>
                <div class="box-footer box-comments" style="display: block;">
                  <div class="box-comment">
                    <img class="img-circle img-sm" src="img/Friends/guy-2.jpg" alt="User Image">
                    <div class="comment-text">
                      <span class="username">
                      Maria Gonzales
                      <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div>
                  </div>

                </div>
                <div class="box-footer" style="display: block;">
                  <form action="#" method="post">
                    <img class="img-responsive img-circle img-sm" src="img/Friends/guy-3.jpg" alt="Alt Text">
                    <div class="img-push">
                      <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    </div>
                  </form>
                </div>
              </div><!--  end posts -->
              @endforeach
            </div><!-- end group posts -->


            <!-- group about -->
            <div class="col-md-5">
              <div class="widget">
                <div class="widget-header">
                  <h3 class="widget-caption">Үйлдлүүд</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                  @if($groupuser)
                    @if($groupuser->status === 0)
                    <button data-id="can_{{$group->id}}" type="button" class="btn btn-azure groupuser"><i class="fa fa-user-times"></i>Хүсэлтийг зогсоох</button>
                    @else
                    <button data-id="ext_{{$group->id}}" type="button" class="btn btn-azure groupuser"><i class="fa fa-user-times"></i>Грүппээс гарах</button>
                    @endif
                  @else
                    <button data-id="add_{{$group->id}}" type="button" class="btn btn-success groupuser"><i class="fa fa-user-plus"></i>Гишүүн болох</button>
                  @endif
                </div>
              </div>

              <div class="widget">
                <div class="widget-header">
                  <h3 class="widget-caption">Грүппийн зорилго</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                  {{$group->description}}
                </div>
              </div>


              @if($groupuser)
              @if($groupuser->status === 2)
              <div class="widget widget-friends">
                <div class="widget-header">
                  <h3 class="widget-caption">Групп-д нэмэх</h3>
                </div>
                <div class="widget-body bordered-top  bordered-sky">
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="img-grid" style="margin: 0 auto;">
                        @foreach($list_users as $list_user)

                        <li>
                          <a href="#">
                            <button data-id="acc_{{$list_user->group_user->id}}" type="button" class="btn btn-success acceptuser"><i class="fa fa-user-plus"></i>{{$list_user->group_user->first_name}}   {{$list_user->group_user->last_name}}</button>

                          </a>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @elseif($groupuser->status === 1)
              <div class="widget widget-friends">
                <div class="widget-header">
                  <h3 class="widget-caption">Гишүү</h3>
                </div>
                <div class="widget-body bordered-top  bordered-sky">
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="img-grid" style="margin: 0 auto;">

                        <li>
                          <a href="#">
                          Гишүүн

                          </a>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @else
              @endif
            </div><!-- end group about -->
          </div>
        </div>
      </div>
    </div>
@endsection
