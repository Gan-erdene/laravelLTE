<?php $banners = App\Models\Banners::where('canview', '1')->orderBy('position', 'asc')->limit(3)->get(); ?>
@foreach($banners as $banner)
  <div class="ibox float-e-margins">
      <a target="_blank" class="bannerclick" data-id="{{$banner->id}}" href="{{$banner->url}}"><img src="{{$banner->image_path}}" style="width:100%"></a>
  </div>
@endforeach
<script>
  $(".bannerclick").on('click', function(){
      var bannerid = $(this).data('id');
      $.post("{{route('bannerAction')}}", {action:'click', bannerid:bannerid, _token:"{{csrf_token()}}"}, function(data){

      });
  });
</script>
