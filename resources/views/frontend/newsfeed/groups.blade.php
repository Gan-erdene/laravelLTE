<div class="widget">
  <div class="widget-header">
    <h3 class="widget-caption"> Грүпүүд </h3>
  </div>
  <div class="widget-body bordered-top bordered-sky">
    <div class="row">
      <div class="col-xs-12">
          <a href="#" data-target="#createGroup" data-toggle="modal" class="btn btn-block purple"> <i class="fa fa-plus"></i> Грүп үүсгэх </a>
      </div>
    </div>
    <div class="card">
        <div class="content">
          <ul class="folder-list" style="padding: 0">
            @foreach($ungroups as $group)
              <li> <a href="{{route('viewGroup', ['groupid'=>$group->id])}}"> <i class="fa fa-users fa-lg"></i> {{str_limit($group->group_name, 30)}}</a></li>
            @endforeach
          </ul>
        </div>
    </div>
  </div>
</div><!-- End people yout may know -->
