<?php

namespace AndreyAsh\SampleProducts;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use AndreyAsh\SampleProducts\SampleProduct;

class SampleProductsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $products = SampleProduct::all()->orderBy('created_at','asc')->get();

    return view('sample-product::index',[ 'products' => $products ]);
  }

  public function getProduct($productId = null)
  {
    if($productId != null)
    {
      $sampleProduct = SampleProduct::findOrFail($productId);  
    } else 
    {
      $sampleProduct = new SampleProduct();
    }

    return view('sample-product::form-' . $this->app('current_user_type'), 
      [ 'sampleProduct' => $sampleProduct, 'isNew' => !$sampleProduct->exists ]);
  }

  public function store(Request $request)
  {

    if ($this->app('current_user_type') == 'admin')
    {
      $validator = Validator::make($request->all()), [
        'name' => 'required|min:10',
        'art'  => 'required|unique:sample_products|regex:[A-Za-z0-9]'
      ]);

    } elseif ($this->app('current_user_type') == 'manager')
    {
      $validator = Validator::make($request->all()), [
        'name' => 'required|min:10',
      ]);

    } else 
    {
      abort(403);
    }

    if ($validator->fails()) {
      return redirect('/sample-product')
              ->withInput()
              ->withErrors($validator);
    }

    if($sampleProduct == null)
    {
      $sampleProduct = new SampleProduct();
    }

    $sampleProduct->name = $request->name;

    if($request->has('art'))
    {
      $sampleProduct->art  = $request->art;  
    }
    
    $sampleProduct->save();

    return redirect('/sample-products');
  }

  public function destroy()
  {
    
  }
}
