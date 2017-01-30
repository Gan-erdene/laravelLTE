<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function addView(Request $request){
      $banners = Banners::orderBy('position', 'asc')->get();
      return view('backend.banner.add', ['banners'=>$banners]);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'add': return $this->storeBanner($request);
        case 'change' :return $this->changeBanner($request);
        case 'click' : $this->plusViewCount($request); break;

        default:
          # code...
          break;
      }
    }

    public function plusViewCount($request){
      $banner = Banners::find($request->input('bannerid'));
      $banner->clickcount = $banner->clickcount+1;
      $banner->update();
    }

    public function uploadBanner($request){
      $file = $request->file('file');
      $filename = Str::random(20);

      $path = str_finish(DIRECTORY_SEPARATOR."bannersodlb", '/');
      $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

      if (!is_dir(public_path().$path)) {
          mkdir(public_path().$path, 0755, true);
      }
      $resize_width = Image::make($file)->width();
      $resize_height = null;

      $image = Image::make($file)->resize($resize_width, $resize_height,
          function (Constraint $constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
          })->encode($file->getClientOriginalExtension(), 75);
      $image->save(public_path().$fullPath, 100);
      return $fullPath;
    }

    public function changeBanner($request){
      $banner = Banners::find($request->input('bannerid'));
      if ($request->file("file")) {
        $banner_path = $this->uploadBanner($request);
        $banner->image_path = $banner_path;
      }

      $banner->canview = $request->input('canview');
      $banner->url = $request->input('url');
      $banner->update();

      return back()->with('status', 'success')->with('message', 'Амжилттай хадгалагдлаа');
    }

    public function storeBanner($request){

    }
}
