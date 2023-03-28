@extends('user_template.layouts.template')
@section('content')

<div class="breadcumb_area bg-img" style="background-image:url('{{ asset('home/img/bg-img/breadcumb.jpg') }}');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>{{$category->Category_Name}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Shop Grid Area Start ##### -->
<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area">

                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-50">
                        <!-- Widget Title -->
                        <h6 class="widget-title mb-30">Danh mục</h6>

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#clothing">
                                    <a href="#">{{$category->Category_Name}}</a>
                                    <ul class="sub-menu collapse show" id="clothing">
                                        @foreach($sub_cate as $subCategory)
                                        <li><a href="#">{{$subCategory->Sub_Category_Name}}</a></li>
                                        @endforeach
                                            <!-- <li><a href="#">Bodysuits</a></li>
                                        <li><a href="#">Dresses</a></li>
                                        <li><a href="#">Hoodies &amp; Sweats</a></li>
                                        <li><a href="#">Jackets &amp; Coats</a></li>
                                        <li><a href="#">Jeans</a></li>
                                        <li><a href="#">Pants &amp; Leggings</a></li>
                                        <li><a href="#">Rompers &amp; Jumpsuits</a></li>
                                        <li><a href="#">Shirts &amp; Blouses</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">Sweaters &amp; Knits</a></li> -->
                                    </ul>
                                </li>
                                <!-- Single Item -->

                            </ul>
                        </div>
                    </div>

                    <!-- ##### Single Widget ##### -->
{{--                    <div class="price-range">--}}
{{--                        <h4>Filter by Price</h4>--}}
{{--                        <form action="{{route('Category', [$category->id, Str::slug($category->slug)])}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="mall-property">--}}
{{--                                <div class="mall-property__label">--}}
{{--                                    Price--}}
{{--                                    <a class="mall-property__clear-filter js-mall-clear-filter" href="javascript:;" data-filter="price" style="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="mall-slider-handles" data-start="{{ $filter_min_price ?? $minPrice1 }}" data-end="{{ $filter_max_price ?? $maxPrice1 }}" data-min="{{ $minPrice1}}" data-max="{{ $maxPrice1 }}" data-target="price" style="width: 100%">--}}
{{--                                </div>--}}
{{--                                <div class="row filter-container-1">--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <input data-min="price" id="skip-value-lower" name="min_price" value="{{ $filter_min_price ?? $minPrice1 }}" readonly>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <input data-max="price" id="skip-value-upper" name="max_price" value="{{ $filter_max_price ?? $maxPrice1 }}" readonly>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <button type="submit" class="btn btn-sm">Filter</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}



                    <!-- ##### Single Widget ##### -->
                    <div class="widget color mb-50 mt-50">
                        <!-- Widget Title 2 -->
                        <p class="widget-title2 mb-30">Color</p>
                        <div class="widget-desc">
                            <ul class="d-flex">
                                <li><a href="#" class="color1"></a></li>
                                <li><a href="#" class="color2"></a></li>
                                <li><a href="#" class="color3"></a></li>
                                <li><a href="#" class="color4"></a></li>
                                <li><a href="#" class="color5"></a></li>
                                <li><a href="#" class="color6"></a></li>
                                <li><a href="#" class="color7"></a></li>
                                <li><a href="#" class="color8"></a></li>
                                <li><a href="#" class="color9"></a></li>
                                <li><a href="#" class="color10"></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- ##### Single Widget ##### -->
                    <div class="widget brands mb-50">
                        <!-- Widget Title 2 -->
                        <p class="widget-title2 mb-30">Brands</p>
                        <div class="widget-desc">
                            <ul>
                                <li><a href="#">Asos</a></li>
                                <li><a href="#">Mango</a></li>
                                <li><a href="#">River Island</a></li>
                                <li><a href="#">Topshop</a></li>
                                <li><a href="#">Zara</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span>{{$category->product_count}} </span> sản phẩm tìm thấy</p>
                                </div>
                                <!-- Sorting -->
                                <div class="product-sorting d-flex">
                                    <p>Sắp xếp</p>
                                    <form action="{{ route('Category', [$category->id, $category->slug]) }}" method="get" id="form-filter">
                                        <select  class="form-control" name="sort_by" onchange="document.getElementById('form-filter').submit()">
                                            <option value="">Tất cả</option>
                                            <option value="thap_nhat" {{ $sort_by === 'thap_nhat' ? 'selected' : '' }}>Giá thấp nhất</option>
                                            <option value="cao_nhat" {{ $sort_by === 'cao_nhat' ? 'selected' : '' }}>Giá cao nhất</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Single Product -->
                        @if(count($product) > 0)
                        @foreach ($product as $products )

                        <div class="col-12 col-sm-6 col-lg-4 search_result">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="{{asset($products->product_img)}}" alt="" style="height: 295px;">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="{{asset($products->product_img)}}" alt="">

                                    <!-- Product Badge -->
                                    <div class="product-badge offer-badge">
                                        <span>-30%</span>
                                    </div>
                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span> {{$products->product_subcategory_name}}</span>
                                    <a href="#">
                                        <h6>{{$products->product_name}}</h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">750.000
                                            &#8363</span>{{ number_format($products->price, 0, ',', '.') }} &#8363</p>

                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="{{route('addToCard', $products->id)}}" class="btn essence-btn"
                                                role="button">Add
                                                to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="col-12 col-sm-6 col-lg-4">
                                Không có sản phẩm nào
                            </div>

                        @endif



                        <!-- Single Product -->
                    </div>

                </div>
                <!-- Pagination -->
                <nav aria-label="navigation">
                    {{ $product->links('vendor.pagination.bootstrap-cate-sort') }}
                </nav>
            </div>
        </div>
    </div>
</section>
@section('scripts')

    <script>
        $('#sort_by').on('change', function (){
            let sort_by = $('#sort_by').val();
            let url = "{{ route('Category', ['id' => $category->id, 'slug' => $category->slug]) }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    sort_by: sort_by
                },
                success:function (data){
                    $('.search_result').html(data);
                }
            });
        });
        // $(function () {
        //     var $propertiesForm = $('.mall-category-filter');
        //     var $body = $('body');
        //     $('.mall-slider-handles').each(function () {
        //         var el = this;
        //         noUiSlider.create(el, {
        //             start: [el.dataset.start, el.dataset.end],
        //             connect: true,
        //             tooltips: true,
        //             range: {
        //                 min: [parseFloat(el.dataset.min)],
        //                 max: [parseFloat(el.dataset.max)]
        //             },
        //             pips: {
        //                 mode: 'range',
        //                 density: 20
        //             }
        //         }).on('change', function (values) {
        //             $('[data-min="' + el.dataset.target + '"]').val(values[0])
        //             $('[data-max="' + el.dataset.target + '"]').val(values[1])
        //             $propertiesForm.trigger('submit');
        //         });
        //     })
        // })


    </script>
@endsection

@endsection
