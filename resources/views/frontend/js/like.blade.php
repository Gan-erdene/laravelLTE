$(document).on('click', '.like',function(event){
  event.preventDefault();
  var btn = $(this);
  var postId = btn.data("id");
  //var isLike = event.target.previousElementSibling == null ? true : false;
//console.log(isLike);
btn.prop('disabled', 'disabled');
  $.post("{{ url('/like') }}", { postId: postId, _token: '{{  csrf_token() }}' }, function(data){
      if(data.status === 'success'){
        console.log(data.message);
        console.log(btn);
        btn.html(data.message);
        btn.prop('disabled', '');
        $('#like_' + postId).html(data.like_count);
      }
  });
});
