<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkTxn;
use App\Models\TxnStatusAction;

class OrderController extends Controller
{
    public function orders(){
      $list = WorkTxn::orderBy('created_at', 'desc')->paginate(15);
      return view('backend.workorder.orders', ['list'=>$list]);
    }

    public function viewOrder($orderid){
      $order = WorkTxn::find($orderid);
      return view('backend.workorder.vieworder', ['order'=>$order]);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'accept': return $this->acceptOrder($request);
        case 'reject': return $this->rejectOrder($request);

        default:
          # code...
          break;
      }
    }

    public function acceptOrder($request){
      $worktxnid = $request->input('orderid');
      $order = WorkTxn::find($orderid);
      $oldstatus = $order->statuscode
      $newstatus = 1;
      $order->statuscode = 1; //batalgaajuulsan
      $status = $order->save();

      if($status){
        return back()->with('status', 'success')->with('message', 'Захиалга баталгаажлаа');
      }else{
        return back()->with('status', 'danger')->with('message', 'Захиалга баталгаажуулах үед алдаа гарлаа');
      }
    }

    public function rejectOrder($request){
      $orderid = $request->input('orderid');
    }
}
