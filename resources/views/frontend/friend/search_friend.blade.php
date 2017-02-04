@foreach($list as $item)
<tr>
  <td>
    @if($item->profile_image)
        <img class="img-circle" src="/uploads/profileimage/{{$item->profile_image}}" alt="">
    @else
        <img  class="img-circle" src="/frontend/img/Profile/default-avatar.png" alt="">
    @endif
    <a href="{{route('userProfile')}}?id={{$item->id}}" class="user-link">{{$item->last_name}} {{$item->first_name}}</a>
    @if(App\Helper\DatabaseHelper::canSee($item->id, 'config_work'))
    <span class="user-subhead">{{$item->work}}</span>
    @else
    <i>----</i>
    @endif
  </td>
  <td>
    {{str_limit($item->ur_zadvar, 100)}}
  </td>
  <td>
    <div class="m-t-xs btn-group">
      @if( isset($item->friend()->status) and $item->friend()->status === 1 )
      <button data-id="acc_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.accept_friend')}}</button>
      <button data-id="dec_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.decline_friend')}}</button>
      @elseif( isset($item->friend()->status) and $item->friend()->status === 0 )
      <button data-id="can_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.cancel_request')}}</button>
      @elseif( isset($item->friend()->status) and $item->friend()->status  === 2)
      <button data-id="ded_{{$item->id}}" class="btn btn-xs btn-white"> {{trans('strings.declined')}}</button>
      @else
      <button data-id="add_{{$item->id}}" class="btn btn-xs btn-white finduser"> {{trans('strings.add_friend')}}</button>
      @endif
    </div>
  </td>
</tr>
@endforeach
