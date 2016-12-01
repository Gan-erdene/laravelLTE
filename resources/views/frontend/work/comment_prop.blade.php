<div id="pid_{{$p->id}}">
  <div id="coms_{{$p->id}}">
    @include('frontend.work.comments', ['comments'=>$p->comment()])
  </div>
</div>
