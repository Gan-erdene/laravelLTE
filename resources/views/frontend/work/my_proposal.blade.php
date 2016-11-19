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
    @if($p->status === 1)
    <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
    @include('frontend.work.comment_prop')
    @elseif($p->status === 0)
    <p><i class="fa fa-check-circle-o" ></i> Санал илгээсэн</p>
    @endif
  </div>
  <br/>
</div>
<br/>
@endforeach
