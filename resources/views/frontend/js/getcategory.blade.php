$(document).on('change', '.selectsection', function(){
  if(this.checked){
      $.post("{{ url('/frontend/home/action') }}", {'_token':"{{ csrf_token() }}",
        action:'category', section_id:this.value
      }, function(data){
          $('#cat_container').append(data.html);
      });
  }else{
    $('.sec_'+this.value).remove();
  }
});
