<div id="inactive" class="modal fade"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-warning ">
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Хэрэглэгч Идэвхгүй болгох</h4>
        </div>
        <form action="/backend/user/action" method="post">
        <div class="modal-body">
          <p>Та хэрэглэгчийг идэвхгүй болгохдоо итгэлтэй байна уу.</p>
          <input type="hidden" id="userid" name="userid">
          <input type="hidden" name="action" value="inactive">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Үгүй</button>
          <button id="btnConfirm" type="submit" class="btn btn-outline">Тийм</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  <!-- /.modal -->
</div>
