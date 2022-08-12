<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function list()
    {
        $categories = Category::select('categories.*')->get();
        return view('admin.category.list', [
            'categories' => $categories
        ]);
    }

    public function addForm()
    {
        return view('admin.category.add');
    }

    public function postAdd(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;

        if($request->avatar){
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $category->avatar = $avatar->storeAs('images/categories', $avatarName);
        }else{
            $category->avatar = '';
        }
      
        $category->save();
        return redirect()->route('admin.category.list');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.list');
    }

    public function updateForm(Category $category)
    {
        return view('admin.category.update',[
            'category'=>$category
        ]);
    }
    public function putUpdate(Category $category, CategoryRequest $request)
    {
        $category->name = $request->name;
        if($request->avatar){
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $category->avatar = $avatar->storeAs('images/categories', $avatarName);
        }else{
            $category->avatar = $category->avatar;
        }
      
        $category->save();
        return redirect()->route('admin.category.list');
    }

    
}
