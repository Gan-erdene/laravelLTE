<?php

namespace App\Http\Controllers;
use App\SectionTranslation;
use App\Category;
use App\CategoryTranslation;
use Illuminate\Http\Request;
use DB;
use Validator;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        $section = SectionTranslation::where('lang','mn')->get();
        $category = Category::all();
        return view('category.categoryAdd')
        ->with('category',$category)
        ->with('section',$section);

    }
    public function create($request){



        $category = new Category;

        $category->section_id = $request->input('section_id');
        $category->published = '1';
        $category->order_id = $request->input('order_id');
        $category->created_by = \Auth::user()->id;
        $category->save();

         $sectionTranslation = new CategoryTranslation;
         $sectionTranslation->id = $category->id;
         $sectionTranslation->name = $request->input('name');
         $sectionTranslation->description = $request->input('description');
         $sectionTranslation->lang = $request->input('catlang');
         $sectionTranslation->save();



         return back()
           ->with('status', 'success')
           ->with('message', 'Хадгалагдлаа');

    }

    public function action(Request $request){
        switch ($request->input('action')) {
            case 'cat': return $this->getCatBySection($request->input('section_id'));
            case 'create' : return $this->create($request);
            case 'category' : return \Response::json(array('category'=>Category::find($request->id), 'translation'=>Category::find($request->id)->CategoryTranslationJoin()->first()));
            case 'edit': return $this->editCategory($request);
            case 'delete': return $this->deleteSection($request);
        default: break;
      }
    }
    public function deleteSection($request){
        $category = Category::find($request->input('deleteid'));
        $category->catTrans("mn")->delete();
        $category->delete();
        return back()
          ->with('status', 'success')
          ->with('message', 'Category амжилттай устгалаа');
    }

    public function messages()
    {
        return [
            'name.required' => 'Ангилал хоосон байж болохгүй!',
            'description.required'  => 'Тайлбар хоосон байж болохгүй!',
            'order_id.required'  => 'Дараалал хоосон байж болохгүй!',
        ];
    }

    public function editCategory($request){
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'description' => 'required',
          'order_id' => 'required',
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
      }

      $category = Category::find($request->input('id'));

      $category->section_id = $request->input('section_id');
      $category->published = '1';
      $category->order_id = $request->input('order_id');
      $category->updated_by = \Auth::user()->id;
      $category->update();

       $sectionTranslation = CategoryTranslation::find($request->input('id'));
       $sectionTranslation->name = $request->input('name');
       $sectionTranslation->description = $request->input('description');
       $sectionTranslation->lang = $request->input('catlang');
       $sectionTranslation->update();
      return back()
        ->with('status', 'success')
        ->with('message', 'Хадгалагдлаа');
    }

    public function getCatBySection($sectionid){
        $sql = "select c.*, t.name from amin.category c left join amin.category_translation t on c.id = t.id where t.lang='mn' and c.section_id=".$sectionid;
        $list = DB::select($sql);
        return $list;
    }


}
