  @foreach($proposals as $p)
  <div id="pid_{{$p->id}}" class="box-comment">
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
      {{$p->proposal}}<br/><br/>
      @if($p->status === 0)
      <p>
        <a class="btn btn-xs confirm_proposal" data-id="{{$p->id}}" data-toggle="modal" data-target="#confirm_proposal" > <i class="fa fa-check right"></i> Саналыг хүлээж авах </a>
        <a class="btn btn-xs reject_proposal" data-id="{{$p->id}}" data-toggle="modal" data-target="#reject_proposal"> <i class="fa fa-remove right"></i> Саналыг татгалзах </a>
      </p>
      @elseif($p->status === 1)
      <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
      @include('frontend.work.comment_prop')
      @elseif($p->status === 2)
      <p><i class="fa fa-remove" ></i> Саналыг татгалзсан</p>
      @endif

    </div>
    <br/>
  </div>
  <br/>
  @endforeach
