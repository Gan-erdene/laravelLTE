<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    }

    public function contractInfo($request){
      
    }
}
