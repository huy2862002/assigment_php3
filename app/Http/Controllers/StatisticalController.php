<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    //
    public function index()
    {
        $count_product = Product::select('products.*')->count();
        $order_success = Order::select('orders.*')
            ->where('status', '=', 3)
            ->count();
        $order_xd = Order::select('orders.*')
            ->where('status', '=', 1)
            ->count();
        $order_dg = Order::select('orders.*')
            ->where('status', '=', 2)
            ->count();
        $order_total = Order::join('order_details', 'orders.id', 'order_details.order_id')
            ->select('orders.*', 'order_details.*')
            ->where('status', '=', 3)
            ->get();
        $total = 0;
        foreach($order_total as $t){
            $total+=$t->total_money;
        }
        return view('admin.statistical.index', [
            'count_product' => $count_product,
            'order_success' => $order_success,
            'order_xd' => $order_xd,
            'order_dg' => $order_dg,
            'total'=>$total
        ]);
    }
}
