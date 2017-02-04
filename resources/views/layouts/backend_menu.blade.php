<ul class="sidebar-menu">
  <li class="header">Цэс</li>
  <li><a href="/backend/home"><i class="fa fa-home"></i> <span>Нүүр</span></a></li>
  <li id="_info" class="treeview">
    <a href="#">
      <i class="fa fa-newspaper-o"></i> <span>Мэдээлэл</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li>
        <a href="/backend/content/add"><i class="fa  fa-angle-double-right"></i> Мэдээлэл нэмэх</a>
      </li>
    </ul>
    <ul class="treeview-menu">
      <li id="_category">
        <a href="#"><i class="fa  fa-angle-double-right"></i> Мэргэжил
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="category_add"><a href="/backend/category/add"><i class="fa fa-angle-double-right"></i> Нэмэх</a></li>
        </ul>
      </li>
      <li id="_section">
        <a href="#"><i class="fa  fa-angle-double-right"></i> Секци
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="sectionadd"><a href="/backend/section/add"><i class="fa fa-angle-double-right"></i> Нэмэх</a></li>
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
      <li id="_user_list"><a href="/backend/user/list"><i class="fa fa-angle-double-right"></i> {{trans('strings.list')}}</a></li>
    </ul>
  </li>
  <li id="_work" class="treeview">
    <a href="#">
      <i class="fa fa-credit-card"></i> <span>Ажлын захиалга</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li id="_work_list"><a href="{{route('workOrders')}}"><i class="fa fa-angle-double-right"></i> Захиалгын жагсаалт</a></li>
    </ul>
  </li>
  <li id="_banner"><a href="{{route('bannerAdd')}}"><i class="fa fa-tags"></i> <span>Сурталчилгаа</span></a></li>
  <li id="_eventx"><a href="{{route('eventList')}}"><i class="fa fa-calendar-check-o "></i> <span>Арга хэмжээ</span></a></li>
  <li id="_help" class="treeview">
    <a href="#">
      <i class="fa fa-question-circle"></i> <span>Тусламж</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li id="_help_add"><a href="{{route('adminViewHelp')}}"><i class="fa fa-angle-double-right"></i> Тусламж нэмэх</a></li>
      <li id="_help_list"><a href="{{route('adminHelpList')}}"><i class="fa fa-angle-double-right"></i> Тусламжууд</a></li>
    </ul>
  </li>
</ul>
