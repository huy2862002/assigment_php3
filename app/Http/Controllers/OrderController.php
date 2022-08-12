<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Admin
    public function list()
    {
        $orders = Order::join('users', 'users.id', 'orders.user_id')
            ->select('orders.*', 'users.*', 'orders.id as orderId', 'orders.status as stt')
            ->where('orders.status', '!=', 0)
            ->paginate(12);
        return view('admin.order.list', [
            'orders' => $orders
        ]);
    }
    // Chi Tiết Đơn Hàng
    public function detail(Order $order)
    {
        $order_detail = Order_detail::join('products', 'products.id', 'order_details.product_id')
            ->select('order_details.*', 'products.*')
            ->where('order_id', '=', $order->id)
            ->get();

        $total = 0;
        foreach ($order_detail as $d) {
            $total += $d->total_money;
        };
        return view('admin.order.detail', [
            'details' => $order_detail,
            'total' => $total
        ]);
    }

    public function delivery(Order $order)
    {
        if ($order->status == 1) {
            $order->status = 2;
            $order->save();
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function success(Order $order)
    {
        if ($order->status != 3) {
            $order->status = 3;
            $order->save();
            return redirect()->back();
        }
        return redirect()->back();
    }
    // Web
    // Add to cart
    public function postAdd(Product $product, Request $request)
    {
        // Id user đăng nhập
        $user_id = Auth::user()->id;
        // Kiểm tra user đăng nhập có đơn hàng trong cart hay không
        $unfinished_order = Order::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 0)
            ->exists();
        // Nếu user chưa có đơn hàng hoặc đơn hàng trước đã giao thì thêm đơn hàng mới
        if ($unfinished_order == false) {
            $new_order = new Order();
            $new_order->user_id = $user_id;
            $new_order->status = 0;
            $new_order->created_at = date("Y/m/d");
            $new_order->save();
        }
        // Lấy thông tin cart
        $order_exist = Order::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 0)
            ->first();
        $order_id_exist = $order_exist->id;
        // Thêm thông tin chi tiết sản phẩm vào cart
        $order_details = new Order_detail();
        // Chuyển chuỗi thành số
        $quantity = intval($request->quantity);
        if ($quantity <= 0) {
            $quantity = 1;
        } else {
            $quantity = intval($request->quantity);
        }
        // Kiểm tra xem sản phẩm đã tồn tại trong đơn hàng chưa
        $product_exist = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.*', 'order_details.*')
            ->where('user_id', '=', $user_id)
            ->where('product_id', '=', $product->id)
            ->where('order_id', '=', $order_id_exist)
            ->exists();
        // Lấy thông tin sản phẩm đã có trong đơn hàng
        $product_exist_info = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.*', 'order_details.*')
            ->where('user_id', '=', $user_id)
            ->where('product_id', '=', $product->id)
            ->where('order_id', '=', $order_id_exist)
            ->first();
        // Lấy thông tin giá sản phẩm
        $price = ($product->price - ($product->price * $product->discount / 100)) * $quantity;
        if ($product_exist == true) {
            $product_exist_info->quantity += $quantity;
            $product_exist_info->total_money += $price;
            $product_exist_info->created_at = date("Y/m/d");
            $product_exist_info->save();
        } else {
            $order_details->order_id = $order_id_exist;
            $order_details->product_id = $product->id;
            $order_details->quantity = $quantity;
            $order_details->total_money = $price;
            $order_details->created_at = date("Y/m/d");
            $order_details->save();
        }
        return redirect()->back();
    }
    // Show cart
    public function showCart()
    {
        $user_id = Auth::user()->id;
        $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('orders.*', 'order_details.*')
            ->where('user_id', '=', $user_id)
            ->where('status', '=', 0)
            ->count();

        $cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', 'products.id')
            ->select('orders.*', 'order_details.*', 'products.*', 'order_details.id as detailId')
            ->where('user_id', '=', $user_id)
            ->where('orders.status', '=', 0)
            ->get();
        $total = 0;
        foreach ($cart as $c) {
            $total += $c->total_money;
        }
        $ship = 0;
        return view('web.order.cart', [
            'cart' => $cart,
            'count_cart' => $count_cart,
            'total' => $total,
            'ship' => $ship
        ]);
    }

    public function delete(Order_detail $cart)
    {
        $order = Order::select('orders.*')
            ->where('id', '=', $cart->order_id)
            ->first();
        if ($order->status == 1 || $order->status == 2) {
            return redirect()->back();
        }
        $cart->delete();
        // Kiểm tra giỏ hàng còn sản phẩm không
        $emptyCart = Order_detail::select('order_details.*')
            ->where('order_details.order_id', '=', $cart->order_id)
            ->exists();
        if ($emptyCart == false) {
            $order->delete();
        }
        return redirect()->back();
    }

    // Đổi số lượng sản phẩm
    public function change(Order_detail $cart, Request $request)
    {
        // Chuyển chuỗi thành số
        $quantity = intval($request->quantity);
        if ($quantity <= 0) {
            $quantity = 1;
        } else {
            $quantity = intval($request->quantity);
        }
        $cart->quantity = $quantity;
        $product = Product::select('products.*')->where('id', '=', $cart->product_id)->first();
        $price = ($product->price - ($product->price * $product->discount / 100)) * $quantity;
        $cart->total_money = $price;
        $cart->save();
        return redirect()->route('web.order.showCart');
    }

    // Thanh Toán

    public function pay()
    {
        $user_id = Auth::user()->id;
        $cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', 'products.id')
            ->select('orders.*', 'order_details.*', 'products.*', 'order_details.id as detailId', 'order_details.order_id as orderId')
            ->where('user_id', '=', $user_id)
            ->where('orders.status', '=', 0)
            ->get();
        $total = 0;
        $code = '';
        foreach ($cart as $c) {
            $total += $c->total_money;
            $code = $c->orderId;
        }
        $ship = 0;
        return view('web.order.pay', [
            'cart' => $cart,
            'total' => $total,
            'ship' => $ship,
            'code' => $code
        ]);
    }

    // Xử lý đơn hàng
    public function handle(Order $order)
    {
        $order->status = 1;
        $order->save();
        return redirect()->route('web.order.showOrder');
    }

    // Đơn hàng của user
    public function showOrder()
    {
        $user_id = Auth::user()->id;
        $order = Order::select('orders.*')
            ->where('user_id', '=', $user_id)
            ->where('status', '!=', 0)
            ->get();
        return view('web.order.orderUser', [
            'order' => $order
        ]);
    }

    // Chi Tiết Đơn Hàng
    public function detail_u(Order $order)
    {
        $order_detail = Order_detail::join('products', 'products.id', 'order_details.product_id')
            ->select('order_details.*', 'products.*')
            ->where('order_id', '=', $order->id)
            ->get();

        $total = 0;
        foreach ($order_detail as $d) {
            $total += $d->total_money;
        };
        return view('web.order.detail', [
            'details' => $order_detail,
            'total' => $total
        ]);
    }

    public function destroy(Order $order)
    {
        if ($order->status != 1) {
            return redirect()->route('home');
        }
        $order->status = 4 ;
        $order->save();
        $order_details = Order_detail::select('order_details.*')
            ->where('order_id', '=', $order->id)
            ->get();
        $detail_id = $order_details->pluck('id');
        Order_detail::whereIn('id', $detail_id)->delete();
        return redirect()->route('web.order.showOrder');
    }
}
