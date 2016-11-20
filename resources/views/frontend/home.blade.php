@extends('layouts.frontend')
@section('javascripts')
<script>
  @include('frontend.js.getcategory')
  $(document).ready(function () {
    $("#menu_add_work").addClass('active');
    @include('frontend.js.like')
  });
</script>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
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
                @if ($user->coverName)
                <div class="image">
                  <img src="\uploads\coverimage\{{$user->coverName}}" class="show-in-modal" alt="people">
                </div>
                  @else
                   <div class="image">
                     <img src="/frontend/img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                   </div>
                  @endif

              <ul class="friends">
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/guy-6.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/woman-3.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/guy-2.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/guy-9.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/woman-9.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/guy-4.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/guy-1.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="/frontend/img/Friends/woman-4.jpg" alt="people" class="img-responsive">
                  </a>
                </li>
                <li><a href="#" class="group"><i class="fa fa-group"></i></a></li>
              </ul>
            </div>
            <div class="cover-info">
              @if($user->profile_image)
              <div class="avatar">
                  <img src="/uploads/profileimage/{{$user->profile_image}}" alt="people">
              </div>
              @else
              <div class="avatar">
                  <img src="/frontend/img/Profile/default-avatar.png" alt="people">
              </div>
              @endif
              <div class="name"><a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></div>
              <ul class="cover-nav">
                <!-- <li class="active"><a href="profile.html"><i class="fa fa-fw fa-bars"></i> Timeline</a></li> -->
                <li class="active"><a href="{{route('frontendEditProfile')}}"><i class="fa fa-fw fa-user"></i> About</a></li>
                <li id='friendView' class="active"><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                <!-- <li class="active"><a href="photos1.html"><i class="fa fa-fw fa-image"></i> Photos</a></li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">About</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <ul class="list-unstyled profile-about margin-none">
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Төрсөн өдөр</span></div>
                    <div class="col-sm-8">{{$user->birthday}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Ажил</span></div>
                    <div class="col-sm-8">{{$user->work}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Хүйс</span></div>
                    @if($user->gender  === 1)
                    <div class="col-sm-8">Эрэгтэй</div>
                    @else
                      <div class="col-sm-8">Эмэгтэй</div>
                    @endif
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Имэйл</span></div>
                    <div class="col-sm-8">{{$user->email_address}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Утас</span></div>
                    <div class="col-sm-8">{{$user->phone}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-4"><span class="text-muted">Ур чадвар</span></div>
                    <div class="col-sm-8">{{$user->ur_zadvar}}</div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="widget widget-friends">
            <div class="widget-header">
              <h3 class="widget-caption">Friends</h3>
            </div>
            <div class="widget-body bordered-top  bordered-sky">
              <div class="row">
                <div class="col-md-12">
                  <ul class="img-grid" style="margin: 0 auto;">
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-6.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/woman-3.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-2.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-9.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/woman-9.jpg" alt="image">
                      </a>
                    </li>
                    <li class="clearfix">
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-4.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-1.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/woman-4.jpg" alt="image">
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <img src="/frontend/img/Friends/guy-6.jpg" alt="image">
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Groups</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <div class="card">
                <div class="content">
                  <ul class="list-unstyled team-members">
                    <li>
                      <div class="row">
                          <div class="col-xs-3">
                              <div class="avatar">
                                  <img src="/frontend/img/Likes/likes-1.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                              </div>
                          </div>
                          <div class="col-xs-6">
                             Github
                          </div>

                          <div class="col-xs-3 text-right">
                              <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                          </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                          <div class="col-xs-3">
                              <div class="avatar">
                                  <img src="/frontend/img/Likes/likes-3.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                              </div>
                          </div>
                          <div class="col-xs-6">
                              Css snippets
                          </div>

                          <div class="col-xs-3 text-right">
                              <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                          </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                          <div class="col-xs-3">
                              <div class="avatar">
                                  <img src="/frontend/img/Likes/likes-2.png " alt="Circle Image" class="img-circle img-no-padding img-responsive">
                              </div>
                          </div>
                          <div class="col-xs-6">
                              Html Action
                          </div>

                          <div class="col-xs-3 text-right">
                              <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                          </div>
                      </div>
                    </li>
                  </ul>
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
                @include('frontend.posts')

                  <!--   posts -->
                  @foreach($posts as $post)
                    @if($post->type == 3)
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/uploads/profileimage/{{Auth::user()->profile_image}}" alt="User Image">
                        <span class="username"><a href="{{ url('/fronted/home',$post->id) }}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}.</a></span>
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
                      <button type="button" data-id="{{$post->id}}"  class="btn btn-default btn-xs like" active><i class="fa fa-thumbs-o-up"></i> {{ \Auth::user()->likes->where('post_id',$post->id)->first() ? 'unlike' : 'like'   }}</button>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                      <span class="pull-right text-muted"><span id="like_{{$post->id}}">{{$post->Likecount()}}</span> </span>
                    </div>

                  </div>
                  @else( $post->type == 2 )
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/uploads/profileimage/{{Auth::user()->profile_image}}" alt="User Image">
                        <span class="username"><a href="{{ url('/fronted/home',$post->id) }}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}.</a></span>
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
                      <button type="button" data-id="{{$post->id}}"  class="btn btn-default btn-xs like" active><i class="fa fa-thumbs-o-up"></i> {{ \Auth::user()->likes->where('post_id',$post->id)->first() ? 'unlike' : 'like'   }}</button>
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
