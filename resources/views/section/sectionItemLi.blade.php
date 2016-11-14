@foreach($sections as $item)
  <li>
    <a href="">
      <label>
        <input value="{{$item->id}}" @if(is_numeric($item->section_id)) checked="checked" @endif  type="checkbox" class="colored-blue selectsection">
        <span class="text">{{$item->section_name}}</span>
      </label>
    </a>
  </li>
@endforeach
