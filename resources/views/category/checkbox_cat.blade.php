@foreach($categories as $category)
<div class="col-md-6 sec_{{$category->section_id}}">
  <label>
      <input value="{{$category->id}}" name="categories[]" type="checkbox" class="colored-blue">
      <span class="text">{{$category->CategoryTranslationJoin->name}}</span>
  </label>
</div>
@endforeach
