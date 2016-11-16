@foreach($works as $work)
<div class="box box-widget">
  <div class="box-header with-border">
    <div class="user-block">

      @if($work->profile_image)
          <img class="img-circle" src="/uploads/profileimage/{{$work->profile_image}}" alt="">
      @else
          <img  class="img-circle" src="/frontend/img/Profile/default-avatar.png" alt="">
      @endif
      <span class="username"><a href="#">{{$work->first_name}} {{$work->last_name}}</a></span>
      <span class="description">Нийтэлсэн: {{date('Y.m.d H:i:s', strtotime($work->created_at))}}</span>
    </div>
  </div>
  <div class="box-body">
    <h4 class="attachment-heading"><a href="{{route('newsfeedWork', $work->id)}}">{{$work->project_name}}</a></h4>
    <p><small>Үнэ: {{$work->price}} - Хугацаа: {{$work->duration}} - Ажил олгогч: <i class="fa fa-check-circle-o" style="color:green"></i> Төлбөрийн системд холбогдсон</small></p>
    <p> {{str_limit($work->reference, 50)}}</p>

    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
    <span class="pull-right text-muted">45 likes</span>
  </div>
</div>
@endforeach
