@extends('layouts.frontend')
@section('javascripts')
<link href="/frontend/assets/css/timeline.css" rel="stylesheet">
<link href="/frontend/assets/css/file_manager.css" rel="stylesheet">
<link href="/frontend/assets/css/user_detail.css" rel="stylesheet">
<style>
.datepicker{z-index:1151 !important;}
</style>
<script>
  @include('frontend.js.getcategory')
  $(document).ready(function () {
    $("#menu_add_work").addClass('active');
    @include('frontend.js.like')
    $.post('{{route("newsfeedAction")}}', {
      action:'post_my' , _token:"{{csrf_token()}}"
    }, function( data ){
      $('#posts').html( data.html );
    });

    $(".textarea").wysihtml5({
      toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": false, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": false, // Button to change color of font
        "blockquote": true, // Blockquote
      }
    });

    $('#addImage').on('click', function(){
      var id = new Date().getTime();
      var old = $('#workImages').html();
      var newhtml = "<div id='div_"+id+"' class='row'><a class='col-md-11'><span class='file-input btn btn-default btn-block btn-file'><input type='file' name='workimages[]' multiple data-id='"+id+"' class='imgInp'>Зурагаа оруулна уу</span></a><a class='btn btn-default btn-sm icon-only removeimage' data-id='"+id+"' ><i class='fa fa-times'></i></a><div class='col-md-12'><img id='img_"+id+"' style='max-width:100%' src='/frontend/img/icon-edit.png' alt='Зурагаа оруулна уу.' /></div></div>";
      $('#workImages').append(newhtml);

      $(".imgInp").change(function(){
          readURL(this);
      });

      $('.removeimage').on('click', function(){
        var id=$(this).data('id');
        $('#div_'+id).remove();
      });
    });

    $('#upload').on('change',function(){
      alert("hi");
      $("#myPostimage").change(function(){
          readPostURL(this);
      });
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
          $(input.files).each(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this);
            reader.onload = function (e) {
                var extention = e.target.result.split('/');
                if('data:image' === extention[0]){
                    $('#img_'+$(input).data('id')).attr('src', e.target.result);
                }else{
                  alert("Зөвхөн зурган файл оруулна уу");
                  return;
                }
            }
          });
        }
    }

    function readPostURL(input) {

        if (input.files && input.files[0]) {
          $(input.files).each(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this);
            reader.onload = function (e) {
                var extention = e.target.result.split('/');
                if('data:image' === extention[0]){
                    $('.myPostimage').attr('src', e.target.result);
                }else{
                  alert("Зөвхөн зурган файл оруулна уу");
                  return;
                }
            }
          });
        }
    }

    $('#workfile').on('change', function(){
      var filename = $(this).val().split('\\').pop();
      $('#uploadfilename').html(filename);
    });

    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd'
     }).on('changeDate', function(e){
        $(this).datepicker('hide');
    });

  });
</script>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>

@endsection
@section('content')
    <div class="row page-content">
    <div class="col-md-8 col-md-offset-2">
      <div class="row">
        <div class="col-md-12">
          <div class="cover profile">
            <div class="wrapper">
                @if ($user->coverName)
                <div class="image">
                  <img src="\uploads\coverimage\{{$user->coverName}}" class="show-in-modal" alt="people">
                </div>
                  @else
                   <div class="image">
                     <img src="/frontend/img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                   </div>
                  @endif
              @include('frontend.home.cover_right_friends',['cover_right_friend'=>$cover_right_friend])
            </div>
            <div class="cover-info">
              @if($user->profile_image)
              <div class="avatar">
                  <img src="/uploads/profileimage/{{$user->profile_image}}" alt="people">
              </div>
              @else
              <div class="avatar">
                  <img src="/frontend/img/Profile/default-avatar.png" alt="people">
              </div>
              @endif
              <div class="name"><a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></div>
              <ul class="cover-nav">
                <!-- <li class="active"><a href="profile.html"><i class="fa fa-fw fa-bars"></i> Timeline</a></li> -->
                <li class="active"><a href="{{route('frontendHome')}}"><i class="fa fa-fw fa-home"></i> Таймлайн</a></li>
                <li class="active"><a href="{{route('frontendEditProfile')}}"><i class="fa fa-fw fa-user"></i> Миний тухай</a></li>
                <li id='friendView' class="active"><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Найзууд</a></li>
                <li class="active"><a href="{{route('photos')}}"><i class="fa fa-fw fa-image"></i> Зураг</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Миний тухай</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky">
              <ul class="list-unstyled profile-about margin-none">
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Товч танилцуулга</span></div>
                    <div class="col-sm-7">{{$user->about}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Имэйл хаяг</span></div>
                    <div class="col-sm-7">{{$user->email_address}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Байршил</span></div>
                    <div class="col-sm-7">{{$user->location}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Хүйс</span></div>
                    @if($user->gender  === 1)
                    <div class="col-sm-7">Эрэгтэй</div>
                    @else
                      <div class="col-sm-7">Эмэгтэй</div>
                    @endif
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Мэргэжил</span></div>
                    <div class="col-sm-7">{{$user->work}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Ур чадвар</span></div>
                    <div class="col-sm-7">{{$user->ur_zadvar}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Утас</span></div>
                    <div class="col-sm-7">{{$user->phone}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Төрсөн өдөр</span></div>
                    <div class="col-sm-7">{{$user->birthday}}</div>
                  </div>
                </li>
                <li class="padding-v-5">
                  <div class="row">
                    <div class="col-sm-5"><span class="text-muted">Гэрийн хаяг</span></div>
                    <div class="col-sm-7">{{$user->address}}</div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          @if(sizeof($groups) > 0)
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-caption">Групп</h3>
            </div>
            <div class="widget-body bordered-top bordered-sky" style="padding: 0">
              <div class="ibox float-e-margins">
                <div class="ibox-content">
                  <div class="file-manager">
                    <ul class="folder-list" style="padding: 0">
                      @foreach($groups as $group)
                        <li> <a href="{{route('viewGroup', ['group_id'=>$group->id])}}"> <i class="fa fa-users"></i> {{str_limit($group->group_name, 30)}}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>


        <!--============= timeline posts-->
        <div class="col-md-7">
          <div class="row">
            <!-- left posts-->
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                <!-- post state form -->
                @include('frontend.posts')
                <div id="posts">
                </div>



                </div>
              </div>
            </div><!-- end left posts-->
          </div>
        </div><!-- end timeline posts-->
      </div>
    </div>
    </div>
@endsection
