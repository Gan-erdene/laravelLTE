<div id="pid_{{$p->id}}">
  <div id="coms_{{$p->id}}">
    @include('frontend.work.comments', ['comments'=>$p->comment()])
  </div>
</div>
<div class="box-footer">
    <div class="input-group">
        <input type="text" data-id="{{$p->id}}" id="comm_{{$p->id}}" class="form-control comment" placeholder="Сэтгэгдэл...">
        <span class="input-group-btn">
            <button class="btn btn-default" data-id="{{$p->id}}" id="btnCommentSend" type="button">Илгээх</button>
        </span>
    </div>
</div>
