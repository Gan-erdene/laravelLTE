@extends('layouts.frontend')
@section('javascripts')

<script>
  $(document).on('change', '.selectsection', function(){
    if(this.checked){
        $.post("{{ url('/frontend/home/action') }}", {'_token':"{{ csrf_token() }}",
          action:'category', section_id:this.value
        }, function(data){
            $('#cat_container').append(data.html);
        });
    }else{
      $('.sec_'+this.value).remove();
    }
  });

  $(document).ready(function () {
    $("#menu_add_work").addClass('active');
  });
</script>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>

<script>
$(document).ready(function(){
  $('.like').click(function(event){
    event.preventDefault();
    var btn = $(this);
    var postId = btn.data("id");
    //var isLike = event.target.previousElementSibling == null ? true : false;
  //console.log(isLike);
  btn.prop('disabled', 'disabled');
    $.post("{{ url('/like') }}", { postId: postId, _token: '{{  csrf_token() }}' }, function(data){
        if(data.status === 'success'){
          console.log(data.message);
          console.log(btn);
          btn.html(data.message);
          btn.prop('disabled', '');
          $('#like_' + postId).html(data.like_count);
        }
    });


  })

})
</script>

@endsection
@section('content')

    <div class="row page-content">
    <div class="col-md-8 col-md-offset-2">
      <div class="row">
        <div class="col-md-12">
          <div class="cover profile">
            <div class="wrapper">

                @if (isset($user_show->coverName))
                <div class="image">
                  <img src="\uploads\coverimage\{{$user_show->coverName}}" class="show-in-modal" alt="people">
                </div>
                  @else
                   <div class="image">
                     <img src="/frontend/img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                   </div>
                  @endif

              @include('frontend.home.cover_right_friends',['cover_right_friend'=>$cover_right_friend])
            </div>
            <div class="cover-info">
              @if($user_show->profile_image)
              <div class="avatar">
                  <img src="/uploads/profileimage/{{$user_show->profile_image}}" alt="people">
              </div>
              @else
              <div class="avatar">
                  <img src="/frontend/img/Profile/default-avatar.png" alt="people">
              </div>
              @endif
              <div class="name"><a href="#">{{ $user_show->first_name }} {{ $user_show->last_name }}</a></div>
              <ul class="cover-nav">
                <li class="active"><a href="{{ url('/frontend/userabout/?id='.$user_show->id)  }}"><i class="fa fa-fw fa-bars"></i> Миний тухай</a></li>
                <li class="active"><a href="{{ url('/frontend/userFriendsList/?id='.$user_show->id)}}"><i class="fa fa-fw fa-user"></i> Найзууд</a></li>
                <li class="active"><a href="{{ url('/frontend/userPhotos/?id='.$user_show->id)}}"><i class="fa fa-fw fa-image"></i> Зураг</a></li>
                <!-- <li id='friendView' class="active"><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Friends</a></li>-->
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Миний тухай</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <ul class="list-unstyled profile-about margin-none">
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Төрсөн өдөр</span></div>
                    <div class="col-sm-8">{{$user_show->birthday}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Ажил</span></div>
                    <div class="col-sm-8">{{$user_show->work}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Хүйс</span></div>
                    @if($user_show->gender  === 1)
                    <div class="col-sm-8">Эрэгтэй</div>
                    @else
                      <div class="col-sm-8">Эмэгтэй</div>
                    @endif
                  </div>
                </li>
                @if($user_settings->where('field_name', 'config_email')->first())
                  <?php $__email = $user_settings->where('field_name', 'config_email')->first(); ?>
                  @if($__email->status === 'all')
                  <li class="padding-v-5">
                    <div class="row">
                      <div class="col-sm-4"><span class="text-muted">Имэйл</span></div>
                      <div class="col-sm-8">{{$user_show->email_address}}</div>
                    </div>
                  </li>
                  @endif
                @endif
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Утас</span></div>
                    <div class="col-sm-8">{{$user_show->phone}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Ур чадвар</span></div>
                    <div class="col-sm-8">{{$user_show->ur_zadvar}}</div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="widget widget-friends">

            <div class="widget-body bordered-top  bordered-sky">
              <div class="row">
                <div class="col-md-12">
                  <img src="/frontend/img/sponsor/sponsor-1.jpg" width="482" />
                </br>
                </div>
              </div>
            </div>
            <div class="widget-body bordered-top  bordered-sky">
              <div class="row">
                <div class="col-md-12">
                  <img src="/frontend/img/sponsor/sponsor-1.jpg" width="482" />
                </br>
                </div>
              </div>
            </div>
            <div class="widget-body bordered-top  bordered-sky">
              <div class="row">
                <div class="col-md-12">
                  <img src="/frontend/img/sponsor/sponsor-1.jpg" width="482" />
                </br>
                </div>
              </div>
            </div>
          </div>


        </div>


        <!--============= timeline posts-->
        <div class="col-md-7">
          <div class="row">
            <!-- left posts-->
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                <!-- post state form -->
                <div class="box profile-info n-border-top">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-post" data-toggle="tab">Мэдээ</a></li>

                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-post">
                      <form action="{{ url('/frontend/home/post') }}"  enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <textarea class="form-control input-lg p-text-area" id="fulltext" name="fulltext" rows="body" placeholder="Юу бодож байна?"></textarea>
                        <div class="box-footer box-form">
                          <button type="submit" class="btn btn-azure pull-right">Нийтлэх</button>
                          <ul class="nav nav-pills">
                            <li><a href="#" onclick="document.getElementById('upload').click(); return true"><i class="fa fa-image"> </i><input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple /></a></li>
                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                            <li><a href="#"><i class=" fa fa-film"></i></a></li>
                            <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                          </ul>
                        </div>
                      </form>
                    </div><!-- end post state form -->

                  </div>
                </div>

                  <!--   posts -->
                  @foreach($posts as $post)
                    @if($post->type == 3)
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/uploads/profileimage/{{$user_show->profile_image}}" alt="User Image">
                        <span class="username"><a href="{{ url('/fronted/home',$post->id) }}">{{$user_show->first_name}} {{$user_show->last_name}}.</a></span>
                        <span class="description">Нийтлэл - {{ date('H:m',strtotime($post->created_at))}}</span>
                      </div>
                    </div>

                    <div class="box-body" style="display: block;">
                      <p>{{$post->reference}}</p>
                      @if($post->filename)
                      <img src="/uploads/post/{{$post->filename}}" alt="">
                      @else

                      @endif
                      <p></p>
                      <button type="button" data-id="{{$post->id}}"  class="btn btn-default btn-xs like" active><i class="fa fa-thumbs-o-up"></i> {{ $user_show->likes->where('post_id',$post->id)->first() ? 'unlike' : 'like'   }}</button>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                      <span class="pull-right text-muted"><span id="like_{{$post->id}}">{{$post->Likecount()}}</span> </span>
                    </div>

                  </div>
                  @else($post->type == 2)
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/uploads/profileimage/{{$user_show->profile_image}}" alt="User Image">
                        <span class="username"><a href="{{ url('/fronted/home',$post->id) }}">{{$user_show->first_name}} {{$user_show->last_name}}.</a></span>
                        <span class="description">Нийтлэл - {{ date('H:m',strtotime($post->created_at))}}</span>
                      </div>
                    </div>

                    <div class="box-body" style="display: block;">
                      <p>{{$post->project_name}}</p>
                      @if($post->filename)
                      <img src="/uploads/post/{{$post->filename}}" alt="">
                      @else

                      @endif
                      <p>{{$post->reference}}</p>
                      <p>{{$post->price}}</p>
                      <button type="button" data-id="{{$post->id}}"  class="btn btn-default btn-xs like" active><i class="fa fa-thumbs-o-up"></i> {{ $user_show->likes->where('post_id',$post->id)->first() ? 'unlike' : 'like'   }}</button>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                      <span class="pull-right text-muted"><span id="like_{{$post->id}}">{{$post->Likecount()}}</span> </span>
                    </div>

                  </div>
                  @endif
                  @endforeach




                </div>
              </div>
            </div><!-- end left posts-->
          </div>
        </div><!-- end timeline posts-->
      </div>
    </div>
    </div>
@endsection
