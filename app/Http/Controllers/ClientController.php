<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Category;
use App\Models\Products;
use App\Models\ShippingInfo;
use App\Models\SubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //
    public function CategoryPage($id, Request $request)
    {

        $allCate = Category::latest()->get();
        $category = Category::findOrFail($id);
        $sub_cate = SubCategory::where('category_id', $id)->get();
        //        $minProductPrice = Products::where('product_category_id', $id)->min('price');
//        $maxProductPrice = Products::where('product_category_id', $id)->max('price');
//        $minPrice1 = $request->input('minPrice') ?? $minProductPrice;
//        $maxPrice1 = $request->input('maxPrice') ?? $maxProductPrice;
        $sort_by = $request->input('sort_by') ?? '';

        // Lấy tất cả các sản phẩm trong danh mục, sắp xếp theo giá và tính toán khoảng giá trên toàn bộ sản phẩm
        $allProducts = Products::where('product_category_id', $id)->get();
        $allProductsSorted = $allProducts->sortBy('price');
        $minPrice = $allProductsSorted->first()->price;
        $maxPrice = $allProductsSorted->last()->price;
        $range = $maxPrice - $minPrice;
        $step = round($range / 100, 2);

        if ($sort_by === 'thap_nhat') {
            $product = Products::where('product_category_id', $id)
                ->whereBetween('price', [$minPrice, $maxPrice])
                ->orderBy('price', 'asc')
                ->paginate(5);
        } elseif ($sort_by === 'cao_nhat') {
            $product = Products::where('product_category_id', $id)
                ->whereBetween('price', [$minPrice, $maxPrice])
                ->orderBy('price', 'desc')
                ->paginate(5);
        } else {
            $product = Products::where('product_category_id', $id)
                ->whereBetween('price', [$minPrice, $maxPrice])
                ->latest()
                ->paginate(5);
        }

        $productSub = Products::where('product_subcategory_id', $id)->latest()->get();

        return view('user_template.Category', compact('category', 'product', 'productSub', 'sub_cate', 'minPrice', 'maxPrice', 'sort_by', 'step'));
    }
    public function sort_by(Request $request, $id, $sort_by = null)
    {
        $categorySearch = Category::findOrFail($id);

        if ($sort_by === "thap_nhat") {
            $productSearch = Products::where('product_category_id', $id)
                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                ->orderBy('price', 'asc')
                ->get();
        } else if ($sort_by === "cao_nhat") {
            $productSearch = Products::where('product_category_id', $id)
                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                ->orderBy('price', 'desc')
                ->get();
        } else {
            $productSearch = Products::where('product_category_id', $id)
                ->whereBetween('price', [$request->minPrice, $request->maxPrice])
                ->latest()
                ->get();
        }

        return $productSearch;
    }
    public function singleProduct($id)
    {
        $product = Products::findOrFail($id);
        $subCate_id = Products::where('id', $id)->value('product_subcategory_id');
        $related = Products::where('product_subcategory_id', $subCate_id)->latest()->get();
        return view('user_template.singleProduct', compact('product', 'related'));
    }
    public function addToCard($id)
    {
        $products = Products::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_name' => $products->product_name,
                'price' => $products->price,
                'product_img' => $products->product_img,
                'quantity' => 1,
                'product_category_name' => $products->product_category_name,

            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', "Đã thêm thành công vào giỏ hàng");

    }
    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            $total = 0;
            $totalQuantity = 0;
            foreach ((array) session('cart') as $id => $details) {
                $total += $details['price'] * $details['quantity'];
                $totalQuantity += $details['quantity'];
            }
            $response = [
                'status' => true,
                'total' => number_format($total, 0, ',', '.'),
                'totalQuantity' => $totalQuantity,
                'count' => count(session('cart'))
            ];
            session()->flash('success', "Xóa thành công");

            return response()->json($response);

        }
    }

    public function StoreOrder(Request $request)
    {
        $user_id = Auth::id(); // Lấy id của user đang đăng nhập

        foreach (session('cart') as $id => $details) {
            $product = Products::findOrFail($id); // Lấy thông tin sản phẩm từ database
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = $user_id;
            $cart->quantity = $details['quantity'];
            $cart->price = $details['price'];
            $cart->save(); // Lưu thông tin giỏ hàng vào database
        }

        session()->forget('cart'); // Xóa giỏ hàng trong session

        return redirect()->back()->with('success', "Đã đặt hàng thành công");
    }
    public function Checkout()
    {
        $provinces = DB::table('shipping_infos')->get();
        $shipping = [];

        foreach ($provinces as $province) {
            $id = $province->id;
            $provinceCode = $province->province;
            $full_name = $province->full_name;
            $phone_number = $province->phone_number;
            $email_address = $province->email_address;
            $districtCode = $province->district;
            $wardsCode = $province->wards;
            $addressDetail = $province->addressDetail;

            // Gọi API để lấy thông tin tương ứng
            $url = 'https://provinces.open-api.vn/api/p/' . $provinceCode;
            $data = json_decode(file_get_contents($url), true);
            $provinceName = $data['name'];

            $url = 'https://provinces.open-api.vn/api/d/' . $districtCode;
            $data = json_decode(file_get_contents($url), true);
            $districtName = $data['name'];

            // Lấy tên của xã/phường
            $url = 'https://provinces.open-api.vn/api/w/' . $wardsCode;
            $data = json_decode(file_get_contents($url), true);
            $wardsName = $data['name'];

            $shipping[] = [
                'full_name' => $full_name,
                'phone_number' => $phone_number,
                'email_address' => $email_address,
                'province_name' => $provinceName,
                'district_name' => $districtName,
                'wards_name' => $wardsName,
                'address_detail' => $addressDetail,
                'id' => $id
            ];
        }
        return view('user_template.Checkout', compact('shipping'));
    }
    public function PendingOrder()
    {
        return view('user_template.pendingOrder');
    }
    public function History()
    {
        return view('user_template.history');
    }
    public function mainShip()
    {
        return view('user_template.mainShip');
    }
    public function addShipping(Request $request)
    {


        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'province' => $request->province,
            'district' => $request->district,
            'wards' => $request->wards,
            'addressDetail' => $request->addressDetail,
            'phone_number' => $request->phone_number,
            'email_address' => $request->email_address,

        ]);
        return redirect()->route('showShippingInfo')->with('message', 'Đã thêm địa chỉ mới thành công!!');

    }
    public function EditShipping($id)
    {
        $shipInfo = ShippingInfo::findOrFail($id);
        return view('user_template.showShippingInfo', compact('shipInfo'));
    }
    public function updateShipping(Request $request)
    {
        $shipId = $request->id;
        ShippingInfo::findOrFail($shipId)->update([
            'full_name' => $request->full_name,
            'province' => $request->province,
            'district' => $request->district,
            'wards' => $request->wards,
            'addressDetail' => $request->addressDetail,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('showShippingInfo')->with('message', 'Đã sửa địa chỉ mới thành công!!');

    }
    public function deleteShip($id)
    {
        $ship = ShippingInfo::findOrFail($id);
        $ship->delete();
        return redirect()->route('showShippingInfo')->with('message', 'Đã xóa địa chỉ có ID: ' . $id . ' thành công!!');

    }
    public function userProfile()
    {
        return view('user_template.userProfile');
    }
    public function showShippingInfo()
    {
        $provinces = DB::table('shipping_infos')->get();
        $shipping = [];

        foreach ($provinces as $province) {
            $id = $province->id;
            $provinceCode = $province->province;
            $full_name = $province->full_name;
            $phone_number = $province->phone_number;
            $email_address = $province->email_address;
            $districtCode = $province->district;
            $wardsCode = $province->wards;
            $addressDetail = $province->addressDetail;

            // Gọi API để lấy thông tin tương ứng
            $url = 'https://provinces.open-api.vn/api/p/' . $provinceCode;
            $data = json_decode(file_get_contents($url), true);
            $provinceName = $data['name'];

            $url = 'https://provinces.open-api.vn/api/d/' . $districtCode;
            $data = json_decode(file_get_contents($url), true);
            $districtName = $data['name'];

            // Lấy tên của xã/phường
            $url = 'https://provinces.open-api.vn/api/w/' . $wardsCode;
            $data = json_decode(file_get_contents($url), true);
            $wardsName = $data['name'];

            $shipping[] = [
                'full_name' => $full_name,
                'phone_number' => $phone_number,
                'email_address' => $email_address,
                'province_name' => $provinceName,
                'district_name' => $districtName,
                'wards_name' => $wardsName,
                'address_detail' => $addressDetail,
                'id' => $id
            ];
        }
        return view('user_template.showShippingInfo', compact('shipping'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }



}