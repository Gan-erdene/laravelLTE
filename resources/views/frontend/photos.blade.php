@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/photos1.css" rel="stylesheet">
@endsection
@section('content')
<div class="row page-content">
      <div class="col-md-8 col-md-offset-2">
        @include('frontend.user.cover', ['user'=>$user])
        <div class="row">
          <div class="col-md-12">
            <div id="grid" class="row">
              @foreach($photos as $photo)
              @if($photo->filename)
                <div class="mix col-sm-3 page1 page4 margin30">
                    <div class="item-img-wrap">
                        <img src="/uploads/post/{{$photo->filename}}" class="img-responsive" alt="workimg">
                        <div class="item-img-overlay">
                            <a href="#" class="show-image">
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div><!-- grid-->
          </div>
        </div>
        <div class="row gallery-bottom">
          <div class="col-sm-6">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
          </div>
          <div class="col-sm-6 text-right">
          <em>Displaying 1 to 8 (of 100 photos)</em>
          </div>
        </div>
        </div>
      </div>
      <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @foreach($photos as $photo)
            @if($photo->filename)
            <h4 class="modal-title" id="myModalLabel">{{$photo->reference}}</h4>
            @endif
            @endforeach
          </div>
          <div class="modal-body text-centers">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
          </div>
        </div>
      </div>
    </div>
@endsection
