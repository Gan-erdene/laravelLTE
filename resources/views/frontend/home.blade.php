@extends('layouts.frontend')
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
                  <a><img src="/uploads/profileimage/{{$user->profile_image}}" alt="people">Зураг өөрчлөх</a>
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
                    <div class="col-sm-8">99046274</div>
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
                    <form>
                        <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
                    </form>
                    <div class="box-footer box-form">
                        <button type="button" class="btn btn-azure pull-right">Post</button>
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                            <li><a href="#"><i class=" fa fa-film"></i></a></li>
                            <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                        </ul>
                    </div>
                  </div><!-- end post state form -->

                  <!--   posts -->
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                        <span class="description">Shared publicly - 7:30 PM Today</span>
                      </div>
                    </div>

                    <div class="box-body" style="display: block;">
                      <img class="img-responsive show-in-modal" src="/frontend/img/Post/young-couple-in-love.jpg" alt="Photo">
                      <p>I took this photo this morning. What do you guys think?</p>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                      <span class="pull-right text-muted">127 likes - 3 comments</span>
                    </div>
                    <div class="box-footer box-comments" style="display: block;">
                      <div class="box-comment">
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-2.jpg" alt="User Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
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
                        <img class="img-responsive img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="Alt Text">
                        <div class="img-push">
                          <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                        </div>
                      </form>
                    </div>
                  </div><!--  end posts-->


                  <!-- post -->
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
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
                        <img class="attachment-img show-in-modal" src="/frontend/img/Photos/2.jpg" alt="Attachment Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-5.jpg" alt="User Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-6.jpg" alt="User Image">
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
                        <img class="img-responsive img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="Alt Text">
                        <div class="img-push">
                          <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                        </div>
                      </form>
                    </div>
                  </div><!-- end post -->

                  <!--  posts -->
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-2.jpg" alt="User Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
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
                        <img class="img-responsive img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="Alt Text">
                        <div class="img-push">
                          <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                        </div>
                      </form>
                    </div>
                  </div><!--  end posts -->

                  <!--   posts -->
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                        <span class="description">Shared publicly - 7:30 PM Today</span>
                      </div>
                    </div>

                    <div class="box-body" style="display: block;">
                      <img class="img-responsive pad show-in-modal" src="/frontend/img/Photos/3.jpg" alt="Photo">
                      <p>I took this photo this morning. What do you guys think?</p>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                      <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                      <span class="pull-right text-muted">127 likes - 3 comments</span>
                    </div>
                    <div class="box-footer box-comments" style="display: block;">
                      <div class="box-comment">
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-2.jpg" alt="User Image">
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
                        <img class="img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="User Image">
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
                        <img class="img-responsive img-circle img-sm" src="/frontend/img/Friends/guy-3.jpg" alt="Alt Text">
                        <div class="img-push">
                          <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                        </div>
                      </form>
                    </div>
                  </div><!--  end posts -->
                </div>
              </div>
            </div><!-- end left posts-->
          </div>
        </div><!-- end timeline posts-->
      </div>
    </div>
    </div>
@endsection
