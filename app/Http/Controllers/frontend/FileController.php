<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use Image;

class FileController extends Controller
{
    public function index(){
      $user = sf_guard_user::find(\Auth::user()->id);
      return view('frontend.file')
      ->with('user',$user);
    }
    public function add(Request $request){







        $user = sf_guard_user::find(\Auth::user()->id);
        if(isset($request->irgenii)){
          $irgenii = $request->file('irgenii');
                $input['irgenii'] = time().'.'.$irgenii->getClientOriginalName();
                $destinationPath = public_path('uploads/irgenii');
                $img = Image::make($irgenii->getRealPath());
                $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['irgenii']);
            $user->irgenii = $input['irgenii'];
        }

        if(isset($request->khoroo)){
          $khoroo = $request->file('khoroo');
                $input['khoroo'] = time().'.'.$khoroo->getClientOriginalName();
                $destinationPath = public_path('uploads/khoroo');
                $img = Image::make($khoroo->getRealPath());
                $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['khoroo']);
            $user->khoroo = $input['khoroo'];
        }

                if(isset($request->tsagdaa)){
                  $tsagdaa = $request->file('tsagdaa');
                        $input['tsagdaa'] = time().'.'.$tsagdaa->getClientOriginalName();
                        $destinationPath = public_path('uploads/tsagdaa');
                        $img = Image::make($tsagdaa->getRealPath());
                        $img->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['tsagdaa']);
                    $user->tsagdaa = $input['tsagdaa'];
                }
                if(isset($request->tseej)){
                  $tseej = $request->file('tseej');
                        $input['tseej'] = time().'.'.$tseej->getClientOriginalName();
                        $destinationPath = public_path('uploads/tseej');
                        $img = Image::make($tseej->getRealPath());
                        $img->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['tseej']);
                    $user->tseej_zurag = $input['tseej'];
                }
        $user->update();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.');
    }
}
