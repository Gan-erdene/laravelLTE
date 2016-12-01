@foreach($proposals as $p)
<div id="pid_{{$p->id}}" class="box box-widget">
  <div class="box-header with-border">
    <div class="user-block">
      <img class="img-circle img-sm" src="{{$p->user->getAvatar()}}" alt="">
    <span class="username">
    {{$p->user->first_name}} {{$p->user->last_name}}
    <span class="text-muted pull-right">{{$p->created_at}}</span>
    </span>
    <span class="description">
      <a><i class="fa fa-star"></i></a>
      <a><i class="fa fa-star"></i></a>
      <a><i class="fa fa-star"></i></a>
      <a><i class="fa fa-star"></i></a>
      <a><i class="fa fa-star"></i></a>
    </span>
  </div>
</div>
<div class="box-body">
    {{$p->proposal}}<br/><br/>
    @if($p->status === 1)
    <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
    @foreach($p->txns() as $txn )
    <p><i class="fa fa-check-circle-o" @if($txn->statuscode === 1) style="color:green" @endif ></i> <span class="text-primary">Шилжүүлсэн дүн: {{number_format($txn->salary)}} ₮ </span> @if($txn->statuscode === 0) <i><small class="text-warning">/ Ажил олгогчийн гүйлгээ баталгаажаагүй байна /</small></i> @endif</p><br/>
    @endforeach
  </div>
  <div class="box-footer box-comments">
    @include('frontend.work.comment_prop')
    @elseif($p->status === 0)
    <p><i class="fa fa-check-circle-o" ></i> Санал илгээсэн</p>
    @endif
  </div>
  <div class="box-footer">
      <div class="input-group">
          <input type="text" data-id="{{$p->id}}" id="comm_{{$p->id}}" class="form-control comment" placeholder="Сэтгэгдэл...">
          <span class="input-group-btn">
              <button class="btn btn-default" data-id="{{$p->id}}" id="btnCommentSend" type="button">Илгээх</button>
          </span>
      </div>
  </div>
</div>
<br/>
@endforeach
