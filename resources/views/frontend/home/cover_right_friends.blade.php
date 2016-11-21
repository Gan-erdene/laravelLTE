<ul class="friends">
  @foreach($cover_right_friend as $friend)
  <li>
    <a href="{{route('userProfile')}}?id={{$friend->id}}">
      <img
      @if($friend->profile_image)
        src="/uploads/profileimage/{{$friend->profile_image}}"
      @else
        src="/frontend/img/Profile/default-avatar.png"
      @endif
      alt="people" class="img-responsive">
    </a>
  </li>
  @endforeach
  <li><a href="{{route('friendsView')}}" class="group"><i class="fa fa-group"></i></a></li>
</ul>
