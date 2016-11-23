@extends('layouts.frontend')
@section('javascripts')
 <link href="/frontend/assets/css/user_detail.css" rel="stylesheet">




@endsection
@section('content')

    <div class="row page-content">
      <div class="col-md-8 col-md-offset-2">
        <div class="row">
          <div class="col-md-12">
            <div class="cover profile">
              <div class="wrapper">
                @if ($user_about->coverName)
                <div class="image">
                  <img src="\uploads\coverimage\{{$user_about->coverName}}" class="show-in-modal" alt="people">
                </div>
                  @else
                   <div class="image">
                     <img src="/frontend/img/Cover/profile-cover.jpg" class="show-in-modal" alt="people">
                   </div>
                  @endif
                @include('frontend.home.cover_right_friends',['cover_right_friend'=>$cover_right_friend])
              </div>
              <div class="cover-info">
                @if( $user_about->profile_image)
                <div class="avatar">
                    <img src="/uploads/profileimage/{{ $user_about->profile_image}}" alt="people">
                </div>
                @else
                <div class="avatar">
                    <img src="/frontend/img/Profile/default-avatar.png" alt="people">
                </div>
                @endif

                <div class="name"><a href="#">{{ $user_about->first_name }} {{ $user_about->last_name }}</a></div>
                <ul class="cover-nav">
                  <li class="active"><a href="{{ url('/frontend/userabout/?id='.$user_about->id)  }}"><i class="fa fa-fw fa-user"></i> Миний тухай</a></li>
                  <li id='friendView'><a href="{{route('friendsView')}}"><i class="fa fa-fw fa-users"></i> Найзууд</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-md-offset-2">
        <div class="row">
          <div class="col-md-12">
            <div class="widget">
            <div class="widget-body">
            <div class="row">
              <div class="col-md-4 col-md-5 col-xs-12">
                <div class="row content-info">
                  @if($user_about->email_address)
                  <div class="col-xs-3">
                    Хүйс:
                  </div>
                  <div class="col-xs-9">
                    @if($user_about->gender  === 1)
                    Эрэгтэй
                    @else
                      Эмэгтэй
                    @endif
                  </div>
                  @else
                  @endif
                  @if($user_about->email_address)
                  <div class="col-xs-3">
                    Имэйл:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->email_address}}
                  </div>
                  @else
                  @endif
                  @if($user_about->phone)
                  <div class="col-xs-3">
                    Утас:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->phone}}
                  </div>
                  @else
                  @endif
                  @if($user_about->birthday)
                  <div class="col-xs-3">
                    Birthday:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->birthday}}
                  </div>
                  @else
                  @endif
                  @if($user_about->work)
                  <div class="col-xs-3">
                   Ажил:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->work}}
                  </div>
                  @else
                  @endif
                  @if($user_about->ur_zadvar)
                  <div class="col-xs-3">
                    Чадвар:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->ur_zadvar}}
                  </div>
                  @else
                  @endif
                  @if($user_about->address)
                  <div class="col-xs-3">
                    Хаяг:
                  </div>
                  <div class="col-xs-9">
                    {{$user_about->address}}
                  </div>
                  @else
                  @endif
                </div>
              </div>
              <div class="col-lg-8 col-md-7 col-xs-12">
                <p class="contact-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
              </div>
            </div>
          </div>
          </div>
          </div>
        </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
          </div>
          <div class="modal-body text-centers">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>




@endsection
