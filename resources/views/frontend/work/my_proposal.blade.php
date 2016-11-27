@foreach($proposals as $p)
<div id="pid_{{$p->id}}" class="box-comment">
  <img class="img-circle img-sm" src="{{$p->user->getAvatar()}}" alt="">
  <div class="comment-text">
    <span class="username">
    {{$p->user->first_name}} {{$p->user->last_name}}
    <span class="text-muted pull-right">{{$p->created_at}}</span>
    </span>
    {{$p->proposal}}<br/><br/>
    @if($p->status === 1)
    <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
    @foreach($p->txns() as $txn )
    <p><i class="fa fa-check-circle-o" @if($txn->statuscode === 1) style="color:green" @endif ></i> <span class="text-primary">Шилжүүлсэн дүн: {{number_format($txn->salary)}} ₮ </span> @if($txn->statuscode === 0) <i><small class="text-warning">/ Ажил олгогчийн гүйлгээ баталгаажаагүй байна /</small></i> @endif</p><br/>
    @endforeach
    @include('frontend.work.comment_prop')
    @elseif($p->status === 0)
    <p><i class="fa fa-check-circle-o" ></i> Санал илгээсэн</p>
    @endif
  </div>
  <br/>
</div>
<br/>
@endforeach
