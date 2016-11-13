<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller
{
  public function imageUpload()
 {
   return view('image-upload');
 }

 /**
 * Manage Post Request
 *
 * @return void
 */
 public function imageUploadPost(Request $request)
 {
  


 }
}
