<?php

namespace App\Http\Controllers;

use App\Mail\ProductPurchased;
use Stripe\Stripe;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::get();
        return view('product.products', compact('products'));
    }

    public function productDetails(Request $request, $id)
    {
        $product = Product::where('id',$id)->first();
        return view('product.product_details',compact('product'));
    }

    public function show(Product $product, Request $request)
    {
        if (auth()->user()->activeSubscription->count()) {
            return redirect()->route('customer.index')->with('success', 'You have already subscribed the plan');
        }
        return view('subscriptions.show', compact('product'));
    }
}
