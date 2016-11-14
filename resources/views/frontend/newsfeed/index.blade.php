@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<script>
  $(document).on('click', '#settinSec', function(){
    $.post('/home/section/action', {'_token':"{{ csrf_token() }}", 'action':'list_li' }, function(data){
          $('#section_list').html(data.html);
    });
  })

</script>
@endsection
@section('content')
<div class="container page-content ">
      <div class="row">
        <!-- left links -->
        <div class="col-md-3">
          <div class="profile-nav">
            <div class="widget">
              <div class="widget-body">
                <div class="user-heading round">
                  <a href="#">
                      <img src="img/Friends/guy-3.jpg" alt="">
                  </a>
                  <h1>John Breakgrow</h1>
                  <p>@username</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a href="#"> <i class="fa fa-user"></i> News feed</a></li>
                  <li>
                    <a href="#">
                      <i class="fa fa-envelope"></i> Messages
                      <span class="label label-info pull-right r-activity">9</span>
                    </a>
                  </li>
                  <li><a href="#"> <i class="fa fa-calendar"></i> Events</a></li>
                  <li><a href="#"> <i class="fa fa-image"></i> Photos</a></li>
                </ul>
              </div>
            </div>

            <div class="ibox float-e-margins">
              <div class="ibox-content">
                  <div class="file-manager">
                      <div class="hr-line-dashed"></div>
                      <h5>Сонирходог сэдэв <button id="settinSec" class="btn btn-default pull-right btn-xs icon-only"><i class="fa fa-cog"></i></button></h5>
                      <ul class="folder-list" id="section_list" style="padding: 0">
                        @foreach($sections as $item)
                          <li> <a href=""> {{$item->secTrans('mn')->name}}</a></li>
                        @endforeach
                      </ul>
                      <div class="controls"><span class="write" data-toggle="tooltip" data-placement="top" title="" data-original-title="New"></span></div>
                      <div class="clearfix"></div>
                  </div>
              </div>
          </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#"> <i class="fa fa-globe"></i> Pages</a></li>
                  <li><a href="#"> <i class="fa fa-gamepad"></i> Games</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
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
                        <img class="img-circle" src="img/Friends/guy-3.jpg" alt="User Image">
                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                        <span class="description">Shared publicly - 7:30 PM Today</span>
                      </div>
                    </div>

                    <div class="box-body" style="display: block;">
                      <img class="img-responsive show-in-modal" src="img/Post/young-couple-in-love.jpg" alt="Photo">
                      <p>I took this photo this morning. What do you guys think?</p>
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
                  </div><!--  end posts-->
                </div>
              </div>
            </div><!-- end left posts-->
          </div>
        </div><!-- end  center posts -->




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
