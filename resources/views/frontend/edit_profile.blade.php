
@extends('layouts.frontend')
@section('javascripts')
@endsection
@section('content')


    <!-- Begin page content -->
    <div class="container page-content edit-profile">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
      @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- NAV TABS -->
          <ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
            <li class="active"><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Profile</a></li>
            <li class=""><a href="#activity-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-rss"></i> Recent Activity</a></li>
            <li class=""><a href="#settings-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> Settings</a></li>
          </ul>
          <!-- END NAV TABS -->
          <div class="tab-content profile-page">
            <!-- PROFILE TAB CONTENT -->
            @if ($message = Session::get('success'))
  		<div class="alert alert-success alert-block">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  		        <strong>{{ $message }}</strong>
  		</div>
  		<img src="/images/{{ Session::get('path') }}">
  		@endif
            <form action="{{ url('/frontend/profile/edit') }}"  enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
            <div class="tab-pane profile active" id="profile-tab">
              <div class="row">
                <div class="col-md-3">
                  <div class="user-info-left">
                    <img src="img/Profile/default-avatar.png" alt="Profile Picture">
                    <h2>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</h2>
                    <div class="contact">
                      <p>

                        <span class="file-input btn btn-azure btn-file">
                          Профайл зураг <input type="file" name="profileimage">
                        </span>

                      </p>
                      <p>
                        <span class="file-input btn btn-azure btn-file">
                          Cover Зураг <input type="file" name="coverimage">
                        </span>
                      </p>
                      <ul class="list-inline social">
                        <li><a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
                        <li><a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="user-info-right">
                    <div class="basic-info">
                      <h3><i class="fa fa-square"></i> Үндсэн мэдээлэл</h3>
                      <p class="data-row">
                        <span class="data-name">Username</span>
                        <input type="text" id="old-password" name="old-password" class="form-control">
                      </p>
                      <p class="data-row">
                        <span class="data-name">Birth Date</span>
                        <span class="data-value">Nov 20, 1988</span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Gender</span>
                        <span class="data-value">Male</span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Website</span>
                        <span class="data-value"><a href="#">www.jonasmith.com</a></span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Last Login</span>
                        <span class="data-value">2 hours ago</span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Date Joined</span>
                        <span class="data-value">Feb 22, 2012</span>
                      </p>
                    </div>
                    <div class="contact_info">
                      <h3><i class="fa fa-square"></i> Contact Information</h3>
                      <p class="data-row">
                        <span class="data-name">Email</span>
                        <span class="data-value">me@jonasmith.com</span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Phone</span>
                        <span class="data-value">(1800) 221 - 876543</span>
                      </p>
                      <p class="data-row">
                        <span class="data-name">Address</span>
                        <span class="data-value">Riverside City 66, 80123 Denver<br>Colorado</span>
                      </p>
                    </div>
                    <div class="about">
                      <h3><i class="fa fa-square"></i> About Me</h3>
                      <p>Dramatically facilitate proactive solutions whereas professional intellectual capital. Holisticly utilize competitive e-markets through intermandated meta-services. Objectively.</p>
                      <p>Monotonectally foster future-proof infomediaries before principle-centered interfaces. Assertively recaptiualize cutting-edge web services rather than emerging "outside the box" thinking. Phosfluorescently cultivate resource maximizing technologies and user-centric convergence. Completely underwhelm cross functional innovation vis-a-vis.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
            </form>

            <!-- END PROFILE TAB CONTENT -->

            <!-- ACTIVITY TAB CONTENT -->
            <div class="tab-pane activity" id="activity-tab">
              <ul class="list-unstyled activity-list">
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> commented on <a href="#">Special Deal 2013</a> <span class="timestamp">12 minutes ago</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> posted <a href="#">a new blog post</a> <span class="timestamp">4 hours ago</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> edited his profile <span class="timestamp">11 hours ago</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> has added review on <a href="#">jQuery Complete Guide</a> book <span class="timestamp">Yesterday</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> liked <a href="#">a post</a> <span class="timestamp">December 12</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> has completed one task <span class="timestamp">December 11</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> uploaded <a href="#">new photos</a> <span class="timestamp">December 5</span>
                  </p>
                </li>
                <li>
                  <i class="fa fa-times activity-icon pull-left"></i>
                  <p>
                    <a href="#">Jonathan</a> has updated his credit card info <span class="timestamp">September 28</span>
                  </p>
                </li>
              </ul>
              <p class="text-center more"><a href="#" class="btn btn-custom-primary">View more <i class="fa fa-long-arrow-right"></i></a></p>
            </div>
            <!-- END ACTIVITY TAB CONTENT -->

            <!-- SETTINGS TAB CONTENT -->
            <div class="tab-pane settings" id="settings-tab">
              <form class="form-horizontal" role="form">
                <fieldset>
                  <h3><i class="fa fa-square"></i> Change Password</h3>
                  <div class="form-group">
                    <label for="old-password" class="col-sm-3 control-label">Old Password</label>
                    <div class="col-sm-4">
                      <input type="password" id="old-password" name="old-password" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-4">
                      <input type="password" id="password" name="password" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password2" class="col-sm-3 control-label">Repeat Password</label>
                    <div class="col-sm-4">
                      <input type="password" id="password2" name="password2" class="form-control">
                    </div>
                  </div>
                </fieldset>
                <fieldset>
                  <h3><i class="fa fa-square"></i> Privacy</h3>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Show my display name</span>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Show my birth date</span>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Show my email</span>
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Show my online status on chat</span>
                    </label>
                  </div>
                </fieldset>
                <h3><i class="fa fa-square"> </i>Notifications</h3>
                <fieldset>
                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Receive message from administrator</span>
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">New product has been added</span>
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Product review has been approved</span>
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" class="colored-blue" checked="checked">
                        <span class="text">Others liked your post</span>
                    </label>
                  </div>
                </fieldset>
              </form>
              <p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Save Changes</a></p>
            </div>
            <!-- END SETTINGS TAB CONTENT -->
          </div>
        </div>
      </div>
    </div>
@endsection
