@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/profile2.css" rel="stylesheet">
<link href="/frontend/assets/css/profile3.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<script>
$(document).on('click', '#save_proposal', function(){
    var  btn = $(this);
    btn.prop('disabled', 'disabled');
    $.post("{{route('workAction')}}", {
      action:'save_proposal', workid:btn.data('id'), '_token':"{{ csrf_token() }}"
    },function(data){
      if(data.status){
        btn.html(data.btntext);
        btn.prop('disabled', '');
      }else{
        btn.prop('disabled', '');
        alert(data.message);
      }
    });
});
</script>
@endsection
@section('content')
<div class="container page-content ">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 col-xs-12">
          <div class="row-xs">
            <div class="main-box clearfix">
              <div class="row profile-user-info">
                <div class="col-sm-9">
                  @include('status')
                  <h2>{{$work->project_name}}</h2>
                  <p>{{trans('strings.category')}}:
                    @foreach($categories as $category)
                    <span class="badge">{{$category->category->CategoryTranslationJoin->name}}</span>
                    @endforeach
                  </p>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="well with-header  with-footer with-body">
                          <div class="header bordered-blue">Тайлбар</div>
                          <div class="body">
                              {{$work->reference}}
                          </div><hr/>
                          <div class="footer">
                            <p><strong>Хугацаа:</strong> {{$work->duration}}</p>
                            <p><strong>Шаардагдах ур чадвар:</strong> {{$work->skill}} </p>
                            <p><strong>Үнэ:</strong> {{$work->price}} </p></div>
                      </div>
                      @if($work->userid === \Auth::user()->id)
                      <div class="box-footer box-comments" style="display: block;">
                          
                        </div>
                        @endif
                  </div>
                </div>
                </div>
                <div class="col-sm-3 profile-social">
                  <div style="top:0px" class="profile-info-left">
                    <div class="action-buttons">
                      @if($work->userid !== \Auth::user()->id)
                      <div class="row">
                        <div class="col-xs-12">
                            @if($proposal)
                            <a disabled="disabled" class="btn btn-azure btn-block"> Санал илгээсэн </a>
                            @else
                            <a href="#" data-toggle="modal" data-target="#sendModal" class="btn btn-azure btn-block"> Ажилд оролцох</a>
                            @endif
                            <button data-id="{{$work->id}}" id="save_proposal" class="btn  btn-block"><i class="fa fa-circle-o"></i> Ажлыг хадгалах</button>
                        </div>
                      </div>
                      @endif
                    </div>
                    <div class="section">
                        <h3>Ажил олгогчийн тухай</h3>
                        <p><i class="fa fa-check-circle-o" style="color:green"></i> Төлбөрийн системд холбогдсон</p>
                    </div>
                    <div class="section">
                      <h3>Statistics</h3>
                      <p><span class="badge">620</span> Likes</p>
                    </div>
                    <div class="section">
                      <h3>Social</h3>
                      <ul class="list-unstyled list-social">
                        <li><a href="#"><i class="fa fa-twitter"></i> @jhongrwo</a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i> John grow</a></li>
                        <li><a href="#"><i class="fa fa-google"></i> johninizzie</a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i> John grow</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if($proposal)
    @else
    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Ажил олгогч уруу санал илгээх</h4>
          </div>
          <form action="{{ route('workAction') }}"enctype="multipart/form-data" method="POST">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="action" value="proposal">
            <input type="hidden" name="workid" value="{{$work->id}}">
          <div class="modal-body">

            <div class="widget">

              <div class="widget-body bordered-top bordered-sky">
                <div class="row">
                    <textarea class="form-control" placeholder="Та өөрийн саналаа оруулна уу..." rows="5" id="proposal" name="proposal"></textarea>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
            <button type="submit" class="btn btn-primary">Илгээх</button>
          </div>
</form>
        </div>
      </div>
    </div>
    @endif

@endsection
