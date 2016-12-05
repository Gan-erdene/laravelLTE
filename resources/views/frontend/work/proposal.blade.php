  @foreach($proposals as $p)
  <div id="pid_{{$p->id}}" class="box box-widget">
    <div class="box-header with-border">
      <div class="user-block">
        @if($p->user->profile_image)
            <img class="img-circle" src="/uploads/profileimage/{{$p->user->profile_image}}" alt="">
        @else
            <img class="img-circle"src="/frontend/img/Profile/default-avatar.png" alt="">
        @endif
        <span class="username">
          {{$p->user->first_name}} {{$p->user->last_name}}
          <div class="pull-right">
          <span class="text-muted">{{$p->created_at}}</span>
          @if($p->status === 1)
          <a href="#" data-toggle="modal" data-propid="{{$p->id}}" data-id="{{$p->user->id}}" data-target="#salary_contract" class="btn btn-primary btn-xs salary_contract"> Цалин шилжүүлэх</a>
          @endif
          </div>
        </span>
        <span class="description" id="rate_{{$p->id}}">
          @include('frontend.work.rates',['pid'=>$p->id,'rate'=>$p->rates ? $p->rates->rate:null, 'user_id'=>$p->user_id])
        </span>
      </div>
    </div>
    <div class="box-body">

      {{$p->proposal}}<br/><br/>
      @if($p->status === 0)
      <p>
        <a class="btn btn-xs confirm_proposal" data-id="{{$p->id}}" data-toggle="modal" data-target="#confirm_proposal" > <i class="fa fa-check right"></i> Саналыг хүлээж авах </a>
        <a class="btn btn-xs reject_proposal" data-id="{{$p->id}}" data-toggle="modal" data-target="#reject_proposal"> <i class="fa fa-remove right"></i> Саналыг татгалзах </a>
      </p>
      @elseif($p->status === 1)
      <p><i class="fa fa-check-circle-o" style="color:green"></i> Саналыг зөвшөөрсөн</p>
        @foreach($p->txns() as $txn )
        <p><i class="fa fa-check-circle-o" @if($txn->statuscode === 1) style="color:green" @endif ></i> <span class="text-primary">Шилжүүлсэн дүн: {{number_format($txn->salary)}} ₮ </span> @if($txn->statuscode === 0) <i><small class="text-warning">/ Ажил олгогчийн гүйлгээ баталгаажаагүй байна /</small></i> @endif</p>
        @endforeach
      </div>
      <div class="box-footer box-comments">
      @include('frontend.work.comment_prop')
      </div>
      <div class="box-footer">
          <div class="input-group">
              <input type="text" data-id="{{$p->id}}" id="comm_{{$p->id}}" class="form-control comment" placeholder="Сэтгэгдэл...">
              <span class="input-group-btn">
                  <button class="btn btn-default" data-id="{{$p->id}}" id="btnCommentSend" type="button">Илгээх</button>
              </span>
          </div>
      </div>
      @elseif($p->status === 2)
      <p><i class="fa fa-remove" ></i> Саналыг татгалзсан</p>
      @endif
    <br/>
  </div>
  <br/>
  @endforeach
