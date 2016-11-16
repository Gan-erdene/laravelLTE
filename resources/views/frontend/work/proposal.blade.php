@if(isset($_proposals))
  @foreach($_proposals as $p)
  <div class="box-comment">
    @if($p->user->profile_image)
        <img class="img-circle img-sm" src="/uploads/profileimage/{{$p->user->profile_image}}" alt="">
    @else
        <img class="img-circle img-sm"src="/frontend/img/Profile/default-avatar.png" alt="">
    @endif
    <div class="comment-text">
      <span class="username">
      {{$p->user->first_name}} {{$p->user->last_name}}
      <span class="text-muted pull-right">{{$p->created_at}}</span>
      </span>
      {{$p->proposal}}<hr/>
      <a class="btn btn-success btn-xs"> <i class="fa fa-check right"></i> Саналыг хүлээж авах </a>
      <a class="btn btn-danger btn-xs"> <i class="fa fa-remove right"></i> Саналыг татгалзах </a>
    </div>
  </div>
  @endforeach

@elseif(isset($_proposal->proposal))
  <div class="box-comment">
    @if($_proposal->user->profile_image)
        <img class="img-circle img-sm" src="/uploads/profileimage/{{$proposal->user->profile_image}}" alt="">
    @else
        <img class="img-circle img-sm"src="/frontend/img/Profile/default-avatar.png" alt="">
    @endif
    <div class="comment-text">
      <span class="username">
      {{$_proposal->user->first_name}} {{$_proposal->user->last_name}}
      <span class="text-muted pull-right">{{$_proposal->created_at}}</span>
      </span>
      {{$_proposal->proposal}}
    </div>
  </div>

@endif
