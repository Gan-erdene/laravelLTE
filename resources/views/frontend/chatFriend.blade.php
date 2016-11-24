@foreach($list as $item)
<a href="messages1.html" class="list-group-item">
  <i class="fa fa-check-circle connected-status"></i>
  <img src="{{$item->friend->getAvatar()}}" alt="" class="img-chat img-thumbnail">
  <span class="chat-user-name">{{$item->friend->first_name}} {{$item->friend->last_name}}</span>
</a>
@endforeach
