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
        @include('frontend.home.cover_right_friends',['cover_right_friend'=>$cover_right_friend])
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
          <li class="active"><a href="{{route('frontendHome')}}"><i class="fa fa-fw fa-home"></i> Таймлайн</a></li>
          <li class="active"><a href="{{route('frontendEditProfile')}}"><i class="fa fa-fw fa-user"></i> Миний тухай</a></li>
          <li id='friendView' class="active"><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Найзууд</a></li>
          <li class="active"><a href="{{route('photos')}}"><i class="fa fa-fw fa-image"></i> Зураг</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
