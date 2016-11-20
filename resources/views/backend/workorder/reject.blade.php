<div id="rejectModal" class="modal fade"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-danger ">
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Захиалгыг цуцлах</h4>
        </div>
        <form action="{{route('actionOrder')}}" method="post">
        <div class="modal-body">
          <p>Та захиалгыг цуцлахдаа итгэлтэй байна уу.</p>
          <input type="hidden" name="orderid" value="{{$order->id}}">
          <input type="hidden" name="action" value="reject">
          <input type="hidden" name="accountno" id="accountno">
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
