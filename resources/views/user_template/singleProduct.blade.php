@extends('user_template.layouts.template')
@section('content')

<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            <img src="{{asset($product->product_img)}}" alt="">
            <img src="{{asset($product->product_img)}}" alt="">
            <img src="{{asset($product->product_img)}}" alt="">
        </div>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span>{{$product->product_category_name}}/span>
            <a href="cart.html">
                <h2>{{$product->product_name}}</h2>
            </a>


            <p class="product-price"><span class="old-price">200.000 &#8363</span>
                {{ number_format($product->price, 0, ',', '.') }} &#8363 </p>
            <p class="product-desc">{{$product->product_long_des}}</p>




            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
    </div>
</section>
<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">

                    <!-- Single Product -->
                    @foreach ($related as $allPr )
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src=" {{asset($allPr->product_img)}}" alt="" style="height: 295px;">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="{{asset($allPr->product_img)}}" alt="">
                            <!-- Favourite -->
                            <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <span> {{$allPr->product_category_name}}</span>
                            <a href="single-product-details.html">
                                <h6>{{$allPr->product_name}}</h6>
                            </a>
                            <p class="product-price">{{ number_format($allPr->price, 0, ',', '.') }} &#8363</p>

                            <!-- Hover Content -->
                            <div class="hover-content">
                                <!-- Add to Cart -->
                                <div class="add-to-cart-btn">
                                    <a href="#" class="btn essence-btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <!-- Single Product -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection