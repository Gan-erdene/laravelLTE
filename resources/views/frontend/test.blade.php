@extends('layouts.frontend')
@section('javascripts')
<script>
$(document).ready(function(){
  $('.like').click(function(event){

    //event.preventDefault;
    //postId = event.target.parentNode.parentNode.dataset['1'];
    var isLike = event.target.previousElementSibling == null ? true : false;
  //console.log(isLike);
    $.post("{{ url('/like') }}", {isLike: isLike, _token: '{{  csrf_token() }}' }, function(data){
        console.log(data);
    });

  })

})
</script>

@endsection
@section('content')
<div class="row page-content">
<div class="col-md-8 col-md-offset-2">
<div class="row">
<a href="#" class="like">Like</a>
<a href="#" class="like">DisLike</a>
</div>
</div>
</div>
@endsection
