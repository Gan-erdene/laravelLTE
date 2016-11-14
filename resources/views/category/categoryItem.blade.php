@foreach($categories as $category)
  <div class="col-md-6 sec_{{$category->section_id}}">
    <label>
        <input value="{{$category->id}}" @if(is_numeric($category->catid)) checked="checked" @endif name="categories[]" type="checkbox" class="colored-blue">
        <span class="text">{{$category->catname}}</span>
    </label>
  </div>
@endforeach
