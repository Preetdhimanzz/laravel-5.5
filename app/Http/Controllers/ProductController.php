<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $method = $request->method();
      if ($request->ajax() && $request->isMethod('get')) {
        $products = Product::paginate(1);
        $products = array('products' => $products , 'is' => false);
        $view = view('products.index',$products)->render();
        return response()->json(['html'=>$view]);
      } else {
        $products = Product::paginate(1);
        $products = array('products' => $products , 'is' => true);
        return view('products.index', $products);
      }


    }
    public function categories(Request $request)
    {
      $method = $request->method();
      if ($request->ajax() && $request->isMethod('get')) {
        $products = Product::paginate(1);
        $products = array('products' => $products , 'is' => false);
        $view = view('categories.index', $products)->render();
        return response()->json(['html'=>$view]);
      } else {
        $products = Product::paginate(1);
        $products = array('products' => $products , 'is' => true);
        return view('categories.index',  $products);
      }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
   {
         $product = $this->validate(request(), [
           'name' => 'required',
           'price' => 'required|numeric'
         ]);
         Product::create($product);
         return back()->with('success', 'Product has been added');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

      // echo "<pre>"; print_r($_POST['objid']);die;
      $id = $request->input('objid');
      $product = Product::find($id);
      // var_dump($product->toArray());die;
      $view = view('products.edit', compact('product','id'))->render();
      return response()->json(['html'=>$view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
