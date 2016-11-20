<div class="col-md-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="file-manager">
                <div class="hr-line-dashed"></div>
                <button class="btn btn-azure btn-block">{{trans('strings.work')}}</button>
                <div class="hr-line-dashed"></div>
                <div class="profile-nav">
                  <ul class="nav nav-pills nav-stacked" >
                      <li id="menu_add_work"><a href="{{route('addWork')}}"><i class="fa fa-plus"></i> {{trans('strings.add_work')}}</a></li>
                      <li id="menu_list_work"><a href="{{route('listWork')}}"><i class="fa fa-bars"></i> {{trans('strings.list_work')}}</a></li>
                  </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
  </div>
