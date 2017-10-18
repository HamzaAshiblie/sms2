<?php
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(Request $request)
    {
        $categories = Category::paginate();
        if($request['message']!=null){
            return view('category',['categories'=> $categories])->with('message');
        }else{
            return view('category',['categories'=>$categories]);
        }
    }

    public function createCategory(Request $request)
    {
        $category = new Category();
        $category->category_name = $request['category_name'];
        $category->category_description = $request['category_description'];
        $message= 'حدث خطأ، لم يتم إضافة الصنف';
        if ($category->save())
        {
            $message='تمت إضافة الصنف بنجاح';
        }

        return redirect()->route('category')->with(['message'=>$message]);
    }
    public function editCategory( Request $request)
    {
        $category = Category::where('id',$request['id'])->first();
        $category->category_name = $request['category_name'];
        $category->category_description = $request['category_description'];
        $category->category_quantity = 0;
        if ($category->update())
        {
            return response()->json($category,200);
        }

        return redirect()->route('category');

    }
    public function deleteCategory( Request $request)
    {
        $category = Category::where('id',$request['id'])->first();
        $message= 'حدث خطأ، لم يتم حذف العميل';
        if ($category->delete())
        {
            $message='تمت حذف الصنف بنجاح';
            return response()->json($category,200);
        }

        return redirect()->route('category')->with(['message'=>$message]);

    }
}