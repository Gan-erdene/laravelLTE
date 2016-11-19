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
                <li class="active"><a href="profile.html"><i class="fa fa-fw fa-bars"></i> Timeline</a></li>
                <li class="active"><a href="{{route('frontendEditProfile')}}"><i class="fa fa-fw fa-user"></i> About</a></li>
                <li id='friendView' class="active"><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                <li class="active"><a href="photos1.html"><i class="fa fa-fw fa-image"></i> Photos</a></li>
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
                <div class="box profile-info n-border-top">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-post" data-toggle="tab">Мэдээ</a></li>
                    <li><a href="#tab-timeline" data-toggle="tab">Following</a></li>
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
                    <div class="tab-pane fade" id="tab-timeline">

                        <textarea data-toggle="modal" href="#myModal" class="form-control input-lg p-text-area"  rows="2" placeholder="Whats in your mind today?">

                        </textarea>

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Өөрийнхөө Cv оруулна уу</h4>
                              </div>
                              <form action="{{ url('/frontend/home/action') }}"enctype="multipart/form-data" method="POST">

                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="action" value="creatework">
                              <div class="modal-body">

                                <div class="widget">

                                  <div class="widget-body bordered-top bordered-sky">


                                    <div class="row">
                                        <div class="col-md-3">
                                        Гарчиг
                                        </div>
                                        <div class="col-md-9 @if($errors->add->first('project_name') !== "") has-error has-feedback @endif">
                                          @if($errors->add->first('project_name') !== "")<label class="control-label" > {{$errors->add->first('project_name')}} </label>@endif
                                          <input type="text" class="form-control input-sm" id="title" name="title" placeholder="гарчиг...">
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                          {{trans('strings.your_skill')}}
                                        </div>
                                        <div class="col-md-9 @if($errors->add->first('reference') !== "") has-error has-feedback @endif">
                                          @if($errors->add->first('reference') !== "")<label class="control-label" > {{$errors->add->first('reference')}} </label>@endif
                                          <textarea class="form-control" placeholder="Таны ур чадвар..." rows="5" id="body" name="body"></textarea>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                          {{trans('strings.section')}}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                              @foreach($sections as $section)
                                                <div class="col-md-6">
                                                  <label>
                                                      <input value="{{$section->id}}"  type="checkbox" class="colored-blue selectsection">
                                                      <span class="text">{{$section->secTrans('mn')->name}}</span>
                                                  </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                          {{trans('strings.category')}}
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row" id="cat_container">

                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-3">
                                          {{trans('strings.price')}}
                                        </div>
                                        <div class="col-md-9">
                                          <input type="text" placeholder="{{trans('strings.price')}}..." class="form-control input-sm" id="price" name="price">
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                      <div class="col-md-3">

                                      </div>
                                      <div class="col-md-9">
                                        <a><span class="file-input btn btn-azure btn-file"><input type="file" id="imagename" name="imagename" multiple="" /> Файл нэмэх</a>
                                      </div>
                                    </div>
                                  </div>


                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                                <button type="submit" class="btn btn-primary">Хадгалах</button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="box-footer box-form">
                          <button type="button" class="btn btn-azure pull-right">Post</button>
                          <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class=" fa fa-film"></i></a></li>
                            <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                          </ul>
                        </div>


                    </div>
                  </div>
                </div>

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
                  @else($post->type == 2)
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
