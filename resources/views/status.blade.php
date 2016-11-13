@if(session('status'))
<div class="alert alert-{{session('status')}} alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="icon fa fa-check"></i> {{session('message')}}
</div>
@endif
