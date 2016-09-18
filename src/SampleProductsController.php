<?php

namespace AndreyAsh\SampleProducts;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use AndreyAsh\SampleProducts\SampleProduct;

use Illuminate\Support\Facades\Validator;

class SampleProductsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $products = SampleProduct::orderBy('created_at','asc')->get();

    return view('sample-product::index',[ 'products' => $products ]);
  }

  public function getForm(Request $request, $productId = null)
  {
    if($productId != null)
    {
      $sampleProduct = SampleProduct::findOrFail($productId);  
    } else 
    {
      $sampleProduct = new SampleProduct();
    }

    return view('sample-product::form-' . app('current_user_type'), 
      [ 'sampleProduct' => $sampleProduct, 'isNew' => !$sampleProduct->exists ]);
  }

  public function create(Request $request)
  {

    if (app('current_user_type') != 'admin')
    {
      abort(403);
    }

    $validator = Validator::make($request->all(), [
      'name' => 'required|min:10',
      'art'  => 'required|unique:sample_products|regex:/^[A-Za-z0-9]+$/'
    ]);

    if ($validator->fails()) {
      return redirect('/sample-product')
              ->withInput()
              ->withErrors($validator);
    }
    
    $sampleProduct = new SampleProduct();
    $sampleProduct->name = $request->name;
    $sampleProduct->art  = $request->art;  
    $sampleProduct->save();

    return redirect('/sample-products');
  }

  public function save(Request $request, $productId)
  {

    $sampleProduct = SampleProduct::findOrFail($productId);

    if (app('current_user_type') == 'admin')
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:10',
        'art'  => 'required|unique:sample_products,art,' . $sampleProduct->id . '|regex:/^[A-Za-z0-9]+$/'
      ]);

    } elseif (app('current_user_type') == 'manager')
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:10',
      ]);

    } else 
    {
      abort(403);
    }

    if ($validator->fails()) {
      return redirect('/sample-product/'.$productId)
              ->withInput()
              ->withErrors($validator);
    }

    $sampleProduct->name = $request->name;

    if($request->has('art'))
    {
      $sampleProduct->art  = $request->art;  
    }
    
    $sampleProduct->save();

    return redirect('/sample-products');
  }

  public function destroy($productId)
  {
    $sampleProduct = SampleProduct::findOrFail($productId);

    $sampleProduct->delete();

    \Session::flash('sp_flash', 'Product ' . $sampleProduct->name . ' sucessfully deleted!');

    return redirect('/sample-products');

  }
}
