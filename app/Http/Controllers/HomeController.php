<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.*', 'order_details.*')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 0)
            ->count();
        }else{
            $count_cart = 0;
        }

        $category = Category::select('categories.*')->first();
        $categories = Category::select('categories.*')
            ->where('id', '!=', $category->id)
            ->get();
        $count = $categories->count();
        $popular = Product::select('products.*')->orderBy('view', 'desc')->limit(8)->get();
        $best = Product::select('products.*')->orderBy('sold', 'desc')->limit(8)->get();
        
        return view('web.home.index', [
            'categories' => $categories,
            'category' => $category,
            'count' => $count,
            'best' => $best,
            'popular' => $popular,
            'count_cart' => $count_cart
        ]);
    }
}
