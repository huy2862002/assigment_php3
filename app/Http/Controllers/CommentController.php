<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function postAdd(Product $product, Request $request)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $product->id;
        $comment->content = $request->content;
        $comment->created_at = date('Y-m-d');
        $comment->save();
        return redirect()->route('web.product.detail', $product->id);
    }
}
