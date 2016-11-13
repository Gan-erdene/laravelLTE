@foreach($list as $item)
<a href="messages1.html" class="list-group-item">
  <i class="fa fa-check-circle connected-status"></i>
  @if($item->profile_image)
  <img src="/uploads/profileimage/{{$item->profile_image}}" alt="" class="img-chat img-thumbnail">
  @else
  <img src="/frontend/img/Profile/default-avatar.png" alt="" class="img-chat img-thumbnail">
  @endif
  <span class="chat-user-name">{{$item->first_name}} {{$item->last_name}}</span>
</a>
@endforeach
