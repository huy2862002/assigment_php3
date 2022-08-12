<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Admin
    public function list()
    {
        $products = Product::join('categories', 'categories.id', 'products.category_id')
            ->select('products.*', 'categories.name as cateName')
            ->paginate(5);
        return view('admin.product.list', [
            'products' => $products
        ]);
    }

    public function changeStatus(Product $product)
    {
        if ($product->status == 0) {
            $product->status = 1;
        } else $product->status = 0;
        $product->save();
        return redirect()->route('admin.product.list');
    }

    public function image(Product $product)
    {
        $images = Image::select('images.*')
            ->where('product_id', '=', $product->id)
            ->get();
        return view('admin.product.image', [
            'images' => $images,
            'product' => $product
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();
        $images = Image::select('images.*')->where('product_id', '=', $product->id)->get();
        $imgId = $images->pluck('id'); // Lấy ra mảng id
        Image::whereIn('id',  $imgId)->delete();
        return redirect()->route('admin.product.list');
    }

    public function addForm()
    {
        $categories = Category::select('categories.*')->get();
        return view('admin.product.add', [
            'categories' => $categories
        ]);
    }

    public function postAdd(ProductRequest $request)
    {
        $product = new Product();
        if (trim(strlen($request->discount)) == 0) {
            $product->discount = 0;
        } else {
            $product->discount = $request->discount;
        }
        if (trim(strlen($request->description)) == 0) {
            $product->description = '';
        } else {
            $product->description = $request->description;
        }
        if ($request->avatar) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $product->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $product->avatar = '';
        }
        $product->view = 0;
        $product->sold = 0;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->insurance = $request->insurance;
        $product->size = $request->size;
        $product->save();
        return redirect()->route('admin.product.list');
    }

    public function updateForm(Product $product)
    {
        $category = Category::select('categories.*')->where('id', '=', $product->category_id)->first();
        $categories = Category::select('categories.*')->where('id', '!=', $category->id)->get();
        return view('admin.product.update', [
            'product' => $product,
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function putUpdate(ProductRequest $request, Product $product)
    {
        if (trim(strlen($request->discount)) == 0) {
            $product->discount = 0;
        } else {
            $product->discount = $request->discount;
        }
        if (trim(strlen($request->description)) == 0) {
            $product->description = '';
        } else {
            $product->description = $request->description;
        }
        if ($request->avatar) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $product->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $product->avatar = $product->avatar;
        }
        $product->view = 0;
        $product->sold = 0;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->insurance = $request->insurance;
        $product->size = $request->size;
        $product->save();
        return redirect()->route('admin.product.list');
    }

    // Web

    public function detailProduct(Product $product)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->select('orders.*', 'order_details.*')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 0)
                ->count();

            $order_user = Order::join('order_details', 'order_details.order_id', '=', 'orders.id')
                ->select('orders.*')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 3)
                ->where('product_id', '=', $product->id)
                ->get();
        } else {
            $count_cart = 0;
        }
        $product->view += 1;
        $product->save();
        $category = Category::select('categories.*')->first();
        $categories = Category::select('categories.*')
            ->where('id', '!=', $category->id)
            ->get();
        $images = Image::select('images.*')
            ->where('product_id', '=', $product->id)
            ->get();
        $similar = Product::select('products.*')
            ->join('categories', 'categories.id', 'products.category_id')
            ->where('products.id', '!=', $product->id)
            ->where('category_id', '=', $product->category_id)
            ->limit(4)->get();
        $comment_product = Comment::join('users', 'users.id', 'comments.user_id')
            ->select('comments.*','users.*', 'users.name as userName', 'comments.created_at as date_comment')
            ->where('product_id', '=', $product->id)
            ->get();
        $comment_exist = Comment::select('comments.*')
            ->where('product_id', '=', $product->id)
            ->where('user_id', '=', Auth::user()->id)
            ->exists();
        $count_comment = $comment_product->count();
        return view('web.product.detail', [
            'product' => $product,
            'images' => $images,
            'similar' => $similar,
            'categories' => $categories,
            'category' => $category,
            'count_cart' => $count_cart,
            'order_user' => $order_user,
            'comment_product' => $comment_product,
            'comment_exist' => $comment_exist,
            'count_comment' => $count_comment
        ]);
    }

    // Trang Sản Phẩm
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->select('orders.*', 'order_details.*')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 0)
                ->count();
        } else {
            $count_cart = 0;
        }
        $category = Category::select('categories.*')->first();
        $categories = Category::select('categories.*')
            ->where('id', '!=', $category->id)
            ->get();
        $products = Product::select('products.*')->paginate(9);
        return view('web.product.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'count_cart' => $count_cart
        ]);
    }

    // Tìm Kiếm Sản Phẩm 
    public function search(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->select('orders.*', 'order_details.*')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 0)
                ->count();
        } else {
            $count_cart = 0;
        }
        $category = Category::select('categories.*')->first();
        $categories = Category::select('categories.*')
            ->where('id', '!=', $category->id)
            ->get();
        $products = Product::select('products.*')
            ->where('name', 'like', '%' . $request->keyword . '%')
            ->paginate(9);

        $count = $products->count();
        return view('web.product.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'count' => $count,
            'count_cart' => $count_cart
        ]);
    }

    public function category($id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $count_cart = Order_detail::join('orders', 'order_details.order_id', '=', 'orders.id')
                ->select('orders.*', 'order_details.*')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 0)
                ->count();
        } else {
            $count_cart = 0;
        }
        $category = Category::select('categories.*')->first();
        $categories = Category::select('categories.*')
            ->where('id', '!=', $category->id)
            ->get();
        $products = Product::select('products.*')
            ->where('category_id', '=', $id)
            ->paginate(9);

        $count = $products->count();
        return view('web.product.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'count' => $count,
            'count_cart' => $count_cart
        ]);
    }
}
