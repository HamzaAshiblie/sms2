<?php
namespace App\Http\Controllers;

use App\Product;
use App\Product_update;
use App\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        $products = Product::where([
            ['isActive', '=', 1]])->get();
        if($request['message']!=null){
            return view('product',['products'=> $products])->with('message');
        }else{
            return view('product',['products'=> $products]);
        }
    }
    public function getDeactivatedProduct(Request $request)
    {
        $products = Product::where([
            ['isActive', '=', 0]])->get();
        if($request['message']!=null){
            return view('deactivatedProduct',['products'=> $products])->with('message');
        }else{
            return view('deactivatedProduct',['products'=> $products]);
        }
    }
    public function getProductSingle(Request $request)
    {
        $products = Product::find($request['product_id']);
        return response()->json($products);
    }
    public function getProductByCat($cat_id)
    {
        $products = Product::where('category_id', $cat_id)->get();
        return view('product',['products'=> $products]);
    }
    public function getProductUpdate($product_id)
    {
        $product_updates = Product_update::where('product_id', $product_id)->get();
        return view('productUpdate',['product_updates'=> $product_updates]);
    }
    public function getProductUpdateByOperation($product_id, $operation)
    {
        $product_updates = Product_update::where([
            ['product_id', '=', $product_id],
            ['operation', '=', $operation]])->get();
        return view('productUpdate',['product_updates'=> $product_updates]);
    }
    public function productCreateProduct(Request $request)
    {
        $category = 'category_id';
        //if ($request['new_category'] != null){
        //   $category = 'new-category';
        //}
        $this->validate($request, [
            'product_name'=> 'required|unique:products',
            $category=>'required',
            //'product_quantity'=>'required',
            'product_unit'=>'required',
            //'supplier'=>'required',
            //'country'=>'required',
            'unit_price'=>'required',
            //'init_price'=>'required'
            'discount'=>'required'
        ]);
        $product = new Product();
        $product->category_id = $request['category_id'];
        $product->product_name = $request['product_name'];
        //$product->product_quantity = $request['product_quantity'];
        $product->product_unit = $request['product_unit'];
        $product->unit_price = $request['unit_price'];
        //$product->init_price = $request['init_price'];
        $product->discount = $request['discount'];
        $product->limit = $request['limit'];
        /*
        if ($product->save())
        {
            $product_update = new Product_update();
            $product_update->product_id = $product->id;
            $product_update->product_quantity = $product->product_quantity;
            $product_update->supplier = $request['supplier'];
            $product_update->country = $request['country'];
            $product_update->operation = 'تعريف منتج';
            $product_update->save();
            return response()->json($product,200);
        }
        */
        $product->save();
        return redirect()->route('product');
    }

    public function activateProduct(Request $request)
    {
        $product = Product::where('id',$request['id'])->first();
        $product->isActive = 1;
        if ($product->update())
        {
            return response()->json($product,200);
        }

        return redirect()->route('deactivatedProduct');

    }

    public function deactivateProduct(Request $request)
    {
        $product = Product::where('id',$request['id'])->first();
        $product->isActive = 0;
        if ($product->update())
        {
            return response()->json($product,200);
        }

        return redirect()->route('deactivatedProduct');

    }

    public function purchaseProduct(Request $request)
    {
        $this->validate($request, [
            'product_id'=>'required',
            'product_quantity'=>'required',
            'supplier'=>'required',
            'country'=>'required',
            'init_price'=>'required',
            'vat'=>'required',
        ]);
        $purchase = new Purchase();
        $purchase->product_id = $request['product_id'];
        $amount_q = $request['product_quantity'];
        $purchase->product_quantity = $request['product_quantity'];
        $last_init = $request['init_price'];
        $amount = $amount_q*($last_init+$request['vat']);
        $purchase->init_price = $request['init_price'];
        $purchase->vat = $request['vat'];
        $purchase->supplier = $request['supplier'];
        $purchase->country = $request['country'];
        if ($purchase->save()){
            $product_update = new Product_update();
            $product_update->product_id = $request['product_id'];
            $product_update->product_quantity = $request['product_quantity'];
            $product_update->supplier = $request['supplier'];
            $product_update->country = $request['country'];
            $product_update->amount = $amount;
            $product_update->operation = 'مشتريات';
            $product_update->save();
            $old_product = Product::where('id',$request['product_id'])->first();
            $old_quantity = $old_product->product_quantity;
            $old_init = $old_product->init_price;
            $max_init = max($last_init, $old_init);
            $updated_quantity = $old_quantity + $request['product_quantity'];
            Product::where('id',$request['product_id'])->update(['product_quantity'=>$updated_quantity, 'init_price'=>$max_init]);
        }
        return response()->json($product_update,200);
    }
    public function editProductSingle( Request $request)
    {
        $this->validate($request, [
            'product_name'=> 'required:products',
            'category_id'=>'required',
            'product_quantity'=>'required',
            'product_unit'=>'required',
            'unit_price'=>'required',
            //'init_price'=>'required'
        ]);
        $product = Product::where('id',$request['id'])->first();
        $product->category_id = $request['category_id'];
        $product->product_name = $request['product_name'];
        $product->product_quantity = $request['product_quantity'];
        $product->product_unit = $request['product_unit'];
        $product->unit_price = $request['unit_price'];
        //$product->init_price = $request['init_price'];
        $product->discount = $request['discount'];
        $product->limit = $request['limit'];
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
        if ($product->delete())
        {
            return response()->json($product,200);
        }
        return redirect()->route('product');

    }
}