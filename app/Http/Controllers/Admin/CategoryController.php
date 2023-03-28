<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function Index()
    {
        $categories = Category::latest()->paginate(5);
        return view('admin.allCategory', compact('categories'));
    }
    public function AddCategory()
    {
        return view('admin.addCategory');
    }
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'Category_Name' => 'required|unique:categories'
        ]);
        Category::insert([
            'Category_Name' => $request->Category_Name,
            'slug' => strtolower(str_replace('', '-', $request->Category_Name))
        ]);
        return redirect()->route('allCategory')->with('message', 'Đã thêm danh mục thành công!!');
    }
    public function EditCategory($id)
    {
        $cateInfo = Category::findOrFail($id);
        return view('admin.editCategory', compact('cateInfo'));
    }
    public function UpdateCategory(Request $request)
    {
        $category_id = $request->category_id;
        $request->validate([
            'Category_Name' => 'required|unique:categories'
        ]);

        Category::findOrFail($category_id)->update([
            'Category_Name' => $request->Category_Name,
            'slug' => strtolower(str_replace('', '-', $request->Category_Name))
        ]);
        return redirect()->route('allCategory')->with('message', 'Đã sửa danh mục thành công!!');

    }
    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('allCategory')->with('message', 'Đã xóa danh mục thành công!!');

    }

}
