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
              @if($groupuser->status === 2)
              <div class="box profile-info n-border-top">
                <form>
                    <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
                </form>
                <div class="box-footer box-form">
                  <button type="button" class="btn btn-azure pull-right">Админ</button>
                  <ul class="nav nav-pills">

                    <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                    <li><a href="#"><i class="fa fa-camera"></i></a></li>
                    <li><a href="#"><i class=" fa fa-film"></i></a></li>
                    <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                  </ul>
                </div>
              </div>
              @elseif($groupuser->status === 1)
              <div class="box profile-info n-border-top">
                <form>
                    <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
                </form>
                <div class="box-footer box-form">
                  <button type="button" class="btn btn-azure pull-right">гишүүн</button>
                  <ul class="nav nav-pills">

                    <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                    <li><a href="#"><i class="fa fa-camera"></i></a></li>
                    <li><a href="#"><i class=" fa fa-film"></i></a></li>
                    <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                  </ul>
                </div>
              </div>
              @endif
              @else

              @endif
              <!--  posts -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="img/Friends/guy-3.jpg" alt="User Image">
                    <span class="username"><a href="#">John Breakgrow jr.</a></span>
                    <span class="description">Shared publicly - 7:30 PM Today</span>
                  </div>
                </div>

                <div class="box-body" style="display: block;">
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac iaculis ligula, eget efficitur nisi. In vel rutrum orci. Etiam ut orci volutpat, maximus quam vel, euismod orci. Nunc in urna non lectus malesuada aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam dignissim mi ac metus consequat, a pharetra neque molestie. Maecenas condimentum lorem quis vulputate volutpat. Etiam sapien diam
                  </p>
                  <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                  <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                  <span class="pull-right text-muted">127 likes - 3 comments</span>
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

                  <div class="box-comment">
                    <img class="img-circle img-sm" src="img/Friends/guy-3.jpg" alt="User Image">
                    <div class="comment-text">
                      <span class="username">
                      Luna Stark
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

              <!-- post -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="img/Friends/guy-3.jpg" alt="User Image">
                    <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                    <span class="description">Shared publicly - 7:30 PM Today</span>
                  </div>
                </div>
                <div class="box-body">
                  <p>Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind
                  texts. Separated they live in Bookmarksgrove right at</p>

                  <p>the coast of the Semantics, a large language ocean.
                  A small river named Duden flows by their place and supplies
                  it with the necessary regelialia. It is a paradisematic
                  country, in which roasted parts of sentences fly into
                  your mouth.</p>

                  <div class="attachment-block clearfix">
                    <img class="attachment-img show-in-modal" src="img/Photos/2.jpg" alt="Attachment Image">
                    <div class="attachment-pushed">
                    <h4 class="attachment-heading"><a href="http://www.bootdey.com/">Lorem ipsum text generator</a></h4>
                    <div class="attachment-text">
                    Description about the attachment can be placed here.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a href="#">more</a>
                    </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                  <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                  <span class="pull-right text-muted">45 likes - 2 comments</span>
                </div>
                <div class="box-footer box-comments">
                  <div class="box-comment">
                    <img class="img-circle img-sm" src="img/Friends/guy-5.jpg" alt="User Image">
                    <div class="comment-text">
                      <span class="username">
                      Maria Gonzales
                      <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                      It is a long established fact that a reader will be distracted
                      by the readable content of a page when looking at its layout.
                    </div>
                  </div>
                  <div class="box-comment">
                    <img class="img-circle img-sm" src="img/Friends/guy-6.jpg" alt="User Image">
                    <div class="comment-text">
                      <span class="username">
                      Nora Havisham
                      <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                      The point of using Lorem Ipsum is that it has a more-or-less
                      normal distribution of letters, as opposed to using
                      'Content here, content here', making it look like readable English.
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <form action="#" method="post">
                    <img class="img-responsive img-circle img-sm" src="img/Friends/guy-3.jpg" alt="Alt Text">
                    <div class="img-push">
                      <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    </div>
                  </form>
                </div>
              </div><!-- end post -->
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
                  <h3 class="widget-caption">Гишүүд</h3>
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
