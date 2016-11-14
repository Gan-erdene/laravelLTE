@foreach($sections as $item)
  <div class="col-md-6">
    <label>
        <input value="{{$item->id}}" @if(is_numeric($item->section_id)) checked="checked" @endif  type="checkbox" class="colored-blue selectsection">
        <span class="text">{{$item->section_name}}</span>
    </label>
  </div>
@endforeach
