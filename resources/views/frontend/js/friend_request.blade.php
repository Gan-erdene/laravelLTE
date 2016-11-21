$(document).on('click', '.finduser', function(){
    var  btn = $(this);
    btn.prop('disabled', 'disabled');
    $.post("{{route('frontendFindUserAction')}}", {
      action:btn.data('id'), '_token':"{{ csrf_token() }}"
    },function(data){
      if(data.status){
        btn.data('id', data.dataid);
        btn.html(data.btntext);
        btn.prop('disabled', '');
      }else{
        btn.prop('disabled', '');
        alert(data.message);
      }
    });
});
