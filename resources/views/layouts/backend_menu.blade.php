<ul class="sidebar-menu">
  <li class="header">Цэс</li>
  <li id="_info" class="treeview">
    <a href="#">
      <i class="fa fa-newspaper-o"></i> <span>Мэдээлэл</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li>
        <a href="/backend/content/add"><i class="fa  fa-plus-circle"></i> Мэдээлэл нэмэх</a>
      </li>
    </ul>
    <ul class="treeview-menu">
      <li id="_category">
        <a href="#"><i class="fa  fa-plus-circle"></i> Ангилал
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="category_add"><a href="/backend/category/add"><i class="fa fa-plus-circle"></i> Нэмэх</a></li>
        </ul>
      </li>
      <li id="_section">
        <a href="#"><i class="fa  fa-plus-circle"></i> Секци
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="sectionadd"><a href="/backend/section/add"><i class="fa fa-plus-circle"></i> Нэмэх</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li id="_user" class="treeview">
    <a href="#">
      <i class="fa fa-user"></i> <span>{{trans('strings.user')}}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li id="_user_list"><a href="/backend/user/list"><i class="fa fa-circle-o"></i> {{trans('strings.list')}}</a></li>
    </ul>
  </li>
  <li id="_work" class="treeview">
    <a href="#">
      <i class="fa fa-user"></i> <span>Ажлын захиалга</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li id="_work_list"><a href="{{route('workOrders')}}"><i class="fa fa-circle-o"></i> Захиалгын жагсаалт</a></li>
    </ul>
  </li>
  <li id="_help" class="treeview">
    <a href="#">
      <i class="fa fa-question-circle"></i> <span>Тусламж</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li id="_help_add"><a href="{{route('adminViewHelp')}}"><i class="fa fa-circle-o"></i> Тусламж нэмэх</a></li>
      <li id="_help_list"><a href="{{route('adminHelpList')}}"><i class="fa fa-circle-o"></i> Тусламжууд</a></li>
    </ul>
  </li>
</ul>
