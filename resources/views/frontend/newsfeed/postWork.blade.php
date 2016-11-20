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
    @if($work->type !== 3)
    <h4 class="attachment-heading"><a href="{{route('newsfeedWork', $work->id)}}">{{$work->project_name}}</a></h4>
    <p>
      <small>Үнэ: {{$work->price}}
      @if($work->type === 1)- Хугацаа: {{$work->startdate}}  @endif
      </small>
    </p>
    <p> {{str_limit($work->reference, 50)}}</p>
    @else
    <p> {{$work->reference}}</p>
    @endif

    <button type="button" data-id="{{$work->id}}"  class="btn btn-default btn-xs like" active><i class="fa fa-thumbs-o-up"></i> {{ \Auth::user()->likes->where('post_id',$work->id)->first() ? 'unlike' : 'like'   }}</button>
    <span class="pull-right text-muted"><span id="like_{{$work->id}}">{{ $work->likecount }}</span> likes</span>
  </div>
</div>
@endforeach
