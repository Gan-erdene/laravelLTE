<div class="modal fade" id="reject_proposal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Саналыг татгалзах</h4>
      </div>
      <form action="{{ route('workAction') }}"enctype="multipart/form-data" method="POST">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" value="reject_proposal">
        <input type="hidden" name="workid" value="{{$work->id}}">
      <div class="modal-body">
        <input type="hidden" name="reject_proposalid" id="reject_proposalid">
        <div class="widget">

          <div class="widget-body bordered-top bordered-sky">
            <div class="row">
                <p>Та саналыг татгалзах гэж байна.</p>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
        <button type="submit" class="btn btn-primary">Тийм</button>
      </div>
</form>
    </div>
  </div>
</div>
