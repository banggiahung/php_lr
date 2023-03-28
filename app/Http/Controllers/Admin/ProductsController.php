<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function Index()
    {
        $allProducts = Products::latest()->paginate(3);
        $categories = Category::latest()->get();
        $subCate = SubCategory::latest()->get();
        return view('admin.allProducts', compact('allProducts','subCate','categories'));
    }
    public function AddProducts()
    {
        $categories = Category::latest()->get();
        $subCate = SubCategory::latest()->get();


        return view('admin.addProducts', compact('categories', 'subCate'));
    }
    public function StoreProducts(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
            'product_long_des' => 'required',
            'product_short_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required'
        ]);
        $image = $request->file('product_img');
        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $imageName);
        $imgUrl = 'upload/' . $imageName;

        $category_id = $request->product_category_id;
        $product_subcategory_id = $request->product_subcategory_id;
        $Category_Name = Category::where('id', $category_id)->value('Category_Name');
        $Sub_Category_Name = SubCategory::where('id', $product_subcategory_id)->value('Sub_Category_Name');

        Products::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_img' => $imgUrl,
            'product_category_name' => $Category_Name,
            'product_subcategory_name' => $Sub_Category_Name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'slug' => strtolower(str_replace('', '-', $request->product_name)),


        ]);
        Category::where('id', $category_id)->increment('product_count', 1);
        SubCategory::where('id', $product_subcategory_id)->increment('product_count', 1);
        return redirect()->route('allProducts')->with('message', 'Đã thêm sản phẩm thành công!!');


    }
//    public function EditImage($id)
//    {
//        $productInfo = Products::findOrFail($id);
//        return view('admin.editImage', compact('productInfo'));
//    }
    public function updateImgProducts(Request $request)
    {
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('product_img');
        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $imageName);
        $imgUrl = 'upload/' . $imageName;

        Products::findOrFail($id)->update([
            'product_img' => $imgUrl,

        ]);
        return redirect()->route('allProducts')->with('message', 'Đã sửa ảnh sản phẩm thành công!!');

    }
    public function EditProducts($id)
    {
        $productInfo = Products::findOrFail($id);
        $categories = Category::latest()->get();
        $subCate = SubCategory::latest()->get();
        return view('admin.editProducts', compact('productInfo', 'categories', 'subCate'));
    }
    public function UpdateProducts(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'product_long_des' => 'required',
            'product_short_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required'
        ]);
        $id = $request->id;

        $category_id = $request->product_category_id;
        $product_subcategory_id = $request->product_subcategory_id;
        $Category_Name = Category::where('id', $category_id)->value('Category_Name');
        $Sub_Category_Name = SubCategory::where('id', $product_subcategory_id)->value('Sub_Category_Name');
        Products::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_name' => $Category_Name,
            'product_subcategory_name' => $Sub_Category_Name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'slug' => strtolower(str_replace('', '-', $request->product_name)),


        ]);
        return redirect()->route('allProducts')->with('message', 'Đã sửa sản phẩm thành công!!');


    }
    public function DeleteProduct($id)
    {
        $cate_id = Products::where('id', $id)->value('product_category_id');
        $subCate_id = Products::where('id', $id)->value('product_subcategory_id');
        Products::findOrFail($id)->delete();

        Category::where('id', $cate_id)->decrement('product_count', 1);
        SubCategory::where('id', $subCate_id)->decrement('product_count', 1);

        return redirect()->route('allProducts')->with('message', 'Đã xóa sản phẩm thành công!!');

    }
}
