@foreach($comments as $comment)
<div class="box-comment">
  @if($comment->user->profile_image)
      <img class="img-circle img-sm" src="/uploads/profileimage/{{$comment->user->profile_image}}" alt="">
  @else
      <img class="img-circle img-sm"src="/frontend/img/Profile/default-avatar.png" alt="">
  @endif
  <div class="comment-text">
    <span class="username">
    {{$comment->user->first_name}} {{$comment->user->last_name}}
    <span class="text-muted pull-right">{{$comment->created_at}}</span>
    </span>
    {{$comment->comment_text}}
  </div>
</div>
@endforeach
