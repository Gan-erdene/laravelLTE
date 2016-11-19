<div class="modal fade" id="salary_contract" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Санал зөвшөөрөх</h4>
      </div>
      <form action="{{ route('workAction') }}"enctype="multipart/form-data" method="POST">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="action" value="confirm_proposal">
        <input type="hidden" name="workid" value="{{$work->id}}">
      <div class="modal-body">
        <input type="hidden" name="confirm_proposalid" id="confirm_proposalid">
        <div class="widget">

          <div class="widget-body bordered-top bordered-sky">
            <div class="row">
                <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                <div class="checkbox">
                                      <label>
                                          <input type="checkbox" class="colored-blue">
                                          <span class="text">Нөхцөлийг зөвшөөрөх</span>
                                      </label>
                                  </div>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Үгүй</button>
        <button type="submit" class="btn btn-primary">Үргэлжлүүлэх</button>
      </div>
</form>
    </div>
  </div>
</div>
