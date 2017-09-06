<?php
namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        $products = Product::paginate();
        if($request['message']!=null){
            return view('product',['products'=> $products])->with('message');
        }else{
            return view('product',['products'=> $products]);
        }
    }

    public function getProductSingle(Request $request)
    {
        $products = Product::find($request['product_id']);
        return response()->json($products);
    }
    public function productCreateProduct(Request $request)
    {
        $this->validate($request, [
            'product_name'=> 'required|unique:products',
            'product_quantity'=>'required',
            'product_unit'=>'required',
            'unit_price'=>'required'
        ]);
        $product = new Product();
        $product->product_name = $request['product_name'];
        $product->product_description = $request['product_description'];
        $product->product_unit = $request['product_unit'];
        $product->unit_price = $request['unit_price'];
        $product->init_price = $request['init_price'];
        $message= 'حدث خطأ، لم يتم إضافة المنتج';
        if ($product->save())
        {
            $message='تمت إضافة المنتج بنجاح';
        }

        return redirect()->route('product')->with(['message'=>$message]);
    }
    public function editProductSingle( Request $request)
    {
        $this->validate($request, [
            'product_name'=> 'required:products',
            'product_quantity'=>'required',
            'product_unit'=>'required',
            'unit_price'=>'required'
        ]);
        $product = Product::where('id',$request['id'])->first();
        $product->product_name = $request['product_name'];
        $product->product_description = $request['product_description'];
        $product->product_quantity = $request['product_quantity'];
        $product->product_unit = $request['product_unit'];
        $product->unit_price = $request['unit_price'];
        $product->init_price = $request['init_price'];
        $message= 'حدث خطأ، لم يتم إضافة المنتج';
        if ($product->update())
        {
            $message='تمت إضافة المنتج بنجاح';
            return response()->json($product,200);
        }

        return redirect()->route('product')->with(['message'=>$message]);

    }
    public function deleteProductSingle( Request $request)
    {
        $product = Product::where('id',$request['id'])->first();
        $message= 'حدث خطأ، لم يتم حذف المنتج';
        if ($product->delete())
        {
            $message='تمت حذف المنتج بنجاح';
            return response()->json($product,200);
        }

        return redirect()->route('product')->with(['message'=>$message]);

    }
}