@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/friends.css" rel="stylesheet">
<link rel="stylesheet" href="/frontend/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="/frontend/tags/app.css">
<script src="/frontend/tags/typeahead.bundle.min.js"></script>
<script src="/frontend/tags/bootstrap-tagsinput.min.js"></script>
<!-- <script src="/frontend/tags/app_bs3.js"></script> -->
<script>
  @include('frontend.js.friend_request')
  $.post("{{route('frontendFindUserAction')}}", {
    action:'lista', '_token':"{{ csrf_token() }}"
  },function(data){
    $("#searchlist").append(data.trlist);
  });
  $(function(){
    var cities = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        url: '/frontend/home/action' ,
        prepare: function (settings) {
            settings.type = "POST";
            settings.data = {action:'category_json', _token:'{{ csrf_token() }}'};
            return settings;
        },
      }
    });
    cities.initialize();

    /**
     * Objects as tags
     */
    elt = $('.example_objects_as_tags > > input');
    elt.tagsinput({
      itemValue: 'value',
      itemText: 'text',
      typeaheadjs: {
        name: 'cities',
        displayKey: 'text',
        source: cities.ttAdapter()
      }
    });
    //elt.tagsinput('add', { "value": 1 , "text": "Amsterdam"   , "continent": "Europe"    });
    // HACK: overrule hardcoded display inline-block of typeahead.js
    $(".twitter-typeahead").css('display', 'inline');

  });
</script>
@endsection
@section('content')
<div class="row page-content">
  <div class="col-md-7 col-md-offset-1">
    <div class="row">
          <div class="widget" style="margin-bottom:0px">
            <div class="table-responsive">
            <table class="table user-list">
              <tbody id="searchlist">

              </tbody>
            </table>
            </div>
            </div>
    </div>
    <div class="row">
      <div class="col-md-2 col-md-offset-5">
        <button class="btn btn-xs btn-white"> Цааш үргэлжлүүлэх <i class="glyphicon glyphicon-chevron-down"></i> </button>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget">
      <div class="widget-header">
        <h3 class="widget-caption"> Та сонирхолоор хайж үзэхүү </h3>
      </div>
      <div class="widget-body bordered-top bordered-sky">
        <div class="row">
          <div class="col-xs-12 example_objects_as_tags">
            <div class="bs-example">
              <input type="text" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
