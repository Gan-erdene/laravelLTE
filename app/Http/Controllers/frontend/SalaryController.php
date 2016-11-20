<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\WorkTxn;

class SalaryController extends Controller
{
    public function action(Request $request){
      switch ($request->input('action')) {
        case 'txn': return $this->createSalary($request);
        case 'info': return $this->contractInfo($request);
        default: break;
      }
    }

    public function createSalary($request){
      $sent_user_id = \Auth::user()->id;
      $workid = $request->input('workid');
      $company_name = $request->input('company_name');
      $work_name = $request->input('work_name');
      $last_name = $request->input('last_name');
      $first_name = $request->input('first_name');
      $regnum = $request->input('regnum');
      $startdate = $request->input('startdate');
      $enddate = $request->input('enddate');
      $salary = $request->input('salary');
      $fee_nd = $request->input('fee_nd');
      $fee_noat = $request->input('fee_noat');
      $txnvalue = $request->input('txnvalue');
      $fee_txn = $request->input('fee_txn');
      $receive_user_id = $rquest->input('receive_user_id');

      $txn = new WorkTxn;
      $txn->workid = $workid;
      $txn->company_name = $company_name;
      $txn->work_name = $work_name;
      $txn->last_name = $last_name;
      $txn->first_name = $first_name;
      $txn->regnum = $regnum;
      $txn->startdate = $startdate;
      $txn->enddate = $enddate;
      $txn->salary = $salary;
      $txn->fee_nd = ($fee_nd/11)*10;
      $txn->fee_noat = $fee_noat;
      $txn->txnvalue = $txnvalue;
      $txn->fee_txn = $fee_txn;
      $txn->fee_ersdel = $fee_nd/11;
      $txn->sent_user_id = $sent_user_id;
      $txn->receive_user_id = $receive_user_id;

      $status = $txn->save();

      if($status){
        return back()->with('status', 'success')->with('message', 'Таны хүсэлтийг хүлээн авлаа');
      }else{
        return back()->with('status', 'danger')->with('message', 'Хүсэлт илгээх үед алдаа гарлаа.');
      }

    }

    public function contractInfo($request){
      $user_id = $request->input('user_id');
      $user = sf_guard_user::find($user_id);
      return response()->json([
        'last_name'=>$user->last_name,
        'first_name'=>$user->first_name,
        'regnum'=>$user->registr ? $user->registr : ""
      ]);
    }
}
