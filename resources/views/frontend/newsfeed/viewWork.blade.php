@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/profile2.css" rel="stylesheet">
<link href="/frontend/assets/css/profile3.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
<script src="/frontend/assets/js/jquery.1.11.0.validate.min.js"></script>
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<style>
.datepicker{z-index:1151 !important;}
</style>
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

$(document).on("click", ".confirm_proposal", function () {
     var proposalid = $(this).data('id');
     $(".modal-body #confirm_proposalid").val( proposalid );
});

$(document).on("click", ".reject_proposal", function () {
     var proposalid = $(this).data('id');
     $(".modal-body #reject_proposalid").val( proposalid );
});
$(document).ready(function(){
  @if($work->userid === \Auth::user()->id)
    $.post("{{route('workAction')}}", {
      action:'proposals', workid:'{{$work->id}}', _token:"{{ csrf_token() }}"
    },function(data){
      $('#proposals').append(data.html);
    });
  @else
    $.post("{{route('workAction')}}", {
      action:'my_prop', workid:'{{$work->id}}', _token:"{{ csrf_token() }}"
    },function(data){
      $('#proposal').append(data.html);
    });
  @endif

  $(document).on('click', '#btnCommentSend', function(){
    commentSend($(this).data('id'));
  });

  $(document).on('keypress', '.comment', function (e) {
         if(e.which === 13){
            commentSend($(this).data('id'));
         }
   });

  function commentSend(propid){
    if($('#comm_'+propid).val().trim().length === 0){
      alert("Хоосон сэтгэгдэл игээх боломжгүй");
      return;
    }
    var input = $('#comm_'+propid);
    var comment = input.val();
    input.val("");
    input.prop('disabled', 'disabled');
    $.post("{{route('commentAction')}}", {
      action:'add', propid:propid, _token:"{{csrf_token()}}", comment:comment
    }, function(data){
      $('#coms_'+data.propid).html(data.comments);
      input.prop('disabled', '');
    })

  }

  $(document).on( 'click', "#salary_agreement", function(){
    $('#btnContinue').prop("disabled", this.checked ? false:true);
  } );

  $(document).on('change paste keyup', '#salary', function(){
      calc(this.value);
  });

  function calc(salary){
    var fee_ndsh = (salary/100)*11;
    var fee_noat = ( parseFloat(salary) + parseFloat(fee_ndsh) )/10;
    var txn_value = parseFloat(fee_ndsh)+parseFloat(fee_noat)+parseFloat(salary)+parseFloat(1500);
    $('#fee_nd').val(fee_ndsh);
    $('#fee_noat').val(fee_noat);
    $('#txnvalue').val(txn_value);
  }

  $(document).on('click', '.salary_contract', function(){
    var propid = $(this).data('propid');
    $.post("{{route('salaryAction')}}",{
      action:'info', _token:"{{csrf_token()}}", user_id:$(this).data('id')
    }, function(data){
        $('#last_name').val(data.last_name);
        $('#first_name').val(data.first_name);
        $('#regnum').val(data.regnum);
        $('#receive_user_id').val(data.user_id);
        $('#proposalid').val(propid);


        $('#company_name').val("{{\Auth::user()->first_name}}");
        $('#work_name').val("{{$work->project_name}}");

        $('#startdate').datepicker( "setDate", new Date({{date('Y,m,d', strtotime($work->startdate))}}) );
        $('#enddate').datepicker( "setDate", new Date({{date('Y,m,d', strtotime($work->enddate))}}) );

    });
  });

  $('#txnForm').validate({ // initialize the plugin
      rules: {
          regnum: {
              required: true,
          },
          company_name: {
              required: true,
          },
          work_name: {
              required: true,
          },
          salary: {
              required: true,number:true,
          },
          last_name: {
              required: true,
          },
          first_name: {
              required: true,
          },
          startdate: {
              required: true,
          },
          enddate: {
              required: true,
          },
      },
      messages:{
        regnum: {
            required: "Регистр хоосон байж болохгүй",
        },
        company_name: {
            required: "Байгууллагын нэр хоосон байж болохгүй",
        },
        work_name: {
            required: "Гүйцэтгэх ажлын утга хоосон байж болохгүй",
        },
        salary: {
            required: "Цалин хоосон байж болохгүй", number:"Цалин талбарт зөвхөн тоон утга оруулна уу"
        },
        last_name: {
            required: "Овог хоосон байж болохгүй",
        },
        first_name: {
            required: "Нэр хоосон байж болохгүй",
        },
        startdate: {
            required: "Эхлэх огноо хоосон байж болохгүй",
        },
        enddate: {
            required: "Дуусах огноо хоосон байж болохгүй",
        },
      },
      highlight: function(element, error) {

        // add a class "has_error" to the element
        $(element).closest('.fmd').addClass('has-error');
      },
      unhighlight: function(element) {
          $(element).parent().removeClass('has-error');
      },
    errorPlacement: function (error, element) {
      $(error).closest('label').addClass('control-label');
      if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.insertAfter(element.parent());
      } else {
          error.insertAfter(element);
      }
    },
      submitHandler: function (form) { // for demo
            form.submitHandler();
        }
  });

  $('.datepicker').datepicker({
     format: 'yyyy-mm-dd'
   }).on('changeDate', function(e){
      $(this).datepicker('hide');
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
                          <div class="header bordered-blue"><small><b>Тайлбар</b></small></div>
                          <div class="body">
                              {!! $work->reference !!}
                              @foreach($work->images() as $image)
                              <img style="max-width:100%" src="/uploads/work/{{$image->timestamp}}.{{$image->extention}}" />
                              @endforeach
                          </div><hr/>
                          <div class="footer">
                            @if($work->type === 1)
                            <p><strong>Хугацаа:</strong> {{$work->startdate}} - {{$work->enddate}}</p>
                            <p><strong>Шаардагдах ур чадвар:</strong> <span>{{$work->skill}}</span> </p>
                            @endif
                            <p><strong>Үнэ:</strong> {{$work->price}} </p>
                            <p><strong>Ажил оруулсан:</strong> {{$work->created_at}}</p>
                            <p><strong>Холбоо барих утас:</strong> {{$work->phone}}</p></div>
                      </div>
                      @if($work->userid === \Auth::user()->id)
                      <div class="box-footer box-comments" style="display: block;" id="proposals">
                      </div>
                      @include('frontend.work.confirm_proposal')
                      @include('frontend.work.reject_proposal')
                      @else
                        <div class="box-footer box-comments" style="display: block;" id="proposal">
                        </div>
                      @endif
                  </div>
                </div>
                </div>
                @if($work->type === 1)
                <div class="col-sm-3 profile-social">
                  <div style="top:0px" class="profile-info-left">
                    <div class="action-buttons">
                      @if($work->userid !== \Auth::user()->id)
                      <div class="row">
                        <div class="col-xs-12">
                            @if(isset($proposal))
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
                        <p><i class="fa fa-fw fa-clock-o" style="color:green"></i> {{date('Y.m.d', strtotime( $userinfo['created_at'] ))}}-с хойш гишүүнээр элссэн</p>
                    </div>
                    <div class="section">
                      <h3></h3>
                      <p><span class="badge">{{$work->Likecount()}}</span> Likes</p>
                      <ul class="list-unstyled list-social">
                        <li><a href="#"><i class="fa fa-plus"></i> Ажил нэмэх</a></li>
                        <li><a href="#"><i class="fa fa-bars"></i> Ажлын жагсаалт</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if($work->userid !== \Auth::user()->id)
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
@include('frontend.work.advSalaryContract')
