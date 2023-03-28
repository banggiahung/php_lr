<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function Index()
    {
        $allSubcategory = SubCategory::latest()->paginate(5);
        $categories = Category::latest()->get();

        return view('admin.allSubCategory', compact('allSubcategory','categories'));
    }
    public function AddSubCategory()
    {
        $categories = Category::latest()->get();
        return view('admin.addSubCategory', compact('categories'));
    }
    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'Sub_Category_Name' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);
        $category_id = $request->category_id;
        $Category_Name = Category::where('id', $category_id)->value('Category_Name');
        SubCategory::insert([
            'Sub_Category_Name' => $request->Sub_Category_Name,
            'slug' => strtolower(str_replace('', '-', $request->Sub_Category_Name)),
            'category_id' => $category_id,
            'Category_Name' => $Category_Name

        ]);

        Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('allSubCategory')->with('message', 'Đã thêm sub thành công!!');

    }
    public function EditSubCategory($id)
    {
        $subCateInfo = SubCategory::findOrFail($id);
        return view('admin.editSubCat', compact('subCateInfo'));
    }
    public function UpdateSubCategory(Request $request)
    {
        $request->validate([
            'Sub_Category_Name' => 'required|unique:sub_categories'
        ]);

        $subcategory_id = $request->subcategory_id;

        SubCategory::findOrFail($subcategory_id)->update([
            'Sub_Category_Name' => $request->Sub_Category_Name,
            'slug' => strtolower(str_replace('', '-', $request->Sub_Category_Name))
        ]);
        return redirect()->route('allSubCategory')->with('message', 'Đã sửa sub thành công!!');

    }
    public function DeleteSubCategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('allSubCategory')->with('message', 'Đã xóa sub thành công!!');

    }
}
