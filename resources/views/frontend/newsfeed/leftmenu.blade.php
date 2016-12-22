<div class="col-md-3">
  <div class="profile-nav">
    <div class="widget">
      <div class="widget-body">
        <div class="user-heading round">
          <a href="#">
            @if(\Auth::user()->profile_image)
                <img class="img-circle" style="object-fit: cover;" src="/uploads/profileimage/{{\Auth::user()->profile_image}}" alt="">
            @else
                <img  class="img-circle" style="object-fit: cover;" src="/frontend/img/Profile/default-avatar.png" alt="">
            @endif
          </a>
          <h1>{{\Auth::user()->first_name}}</h1>
          <p id="userrate">

          </p>
        </div>

        <ul class="nav nav-pills nav-stacked">
          <li id="savedwork">
            <a href="/frontend/newsfeed?s_d=1">
              <i class="fa fa-save"></i> Хадгалсан ажил
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-content">
          <div class="file-manager">
              <div class="hr-line-dashed"></div>
              <h5>{{trans('strings.section')}} <a href="/frontend/profile?s=c" class="btn btn-default pull-right btn-xs icon-only"><i class="fa fa-cog"></i></a></h5>
              <ul class="folder-list" style="padding: 0">
                @foreach($userSections as $section)
                  <li id="m_s_{{$section->id}}"> <a href="{{route('newsfeedIndex')}}?m_s={{$section->id}}"> {{$section->section_name}}</a></li>
                @endforeach
              </ul>
              <h5>{{trans('strings.category')}}</h5>
              <ul class="folder-list" style="padding: 0">
                @foreach($userCategories as $category)
                  <li id="m_c_{{$category->catid}}"> <a href="{{route('newsfeedIndex')}}?m_c={{$category->catid}}"> {{isset($category->category->CategoryTranslationJoin->name) ? $category->category->CategoryTranslationJoin->name : ""}}</a></li>
                @endforeach
              </ul>
              <div class="clearfix"></div>
          </div>
      </div>
  </div>
  </div>
</div>
