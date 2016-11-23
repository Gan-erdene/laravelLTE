<div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Шинэ грүп үүсгэх</h4>
      </div>
      <form action="{{ route('groupAction') }}"enctype="multipart/form-data" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="action" value="create">
          <div class="modal-body">
            <div class="widget">

              <div class="widget-body bordered-top bordered-sky">
                <div class="row">
                  <div class="form-group">
                      <label for="group_name">Грүппийн нэр</label>
                      <input maxlength="100" type="text" class="form-control" id="group_name" name="group_name" placeholder="Грүппийн нэрээ оруулна уу">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                      <label for="group_name">Грүппийн тайлбар</label>
                      <textarea class="form-control" name="description" placeholder="Та грүппийн зорилгоо оруулна уу" id="description"></textarea>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
            <button type="submit" class="btn btn-primary">Үүсгэх</button>
          </div>
      </form>
    </div>
  </div>
</div>
