@php
$categories = App\Models\Category::latest()->get();
$products = App\Models\Products::latest()->get();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Fashion Ecommerce Template</title>
    <!-- Favicon  -->
    <link rel="icon" href=" {{asset('home/img/core-img/favicon.ico')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href=" {{asset('home/css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('home/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js" integrity="sha512-UOJe4paV6hYWBnS0c9GnIRH8PLm2nFK22uhfAvsTIqd3uwnWsVri1OPn5fJYdLtGY3wB11LGHJ4yPU1WFJeBYQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
.nice-select{
    width: 12em;
}
.bold-700{
    font-weight: 700;
}
.bold-500{
    font-weight: 500;

}

</style>
<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.html"><img src=" {{asset('home/img/core-img/logo.png')}}" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="#">Shop</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        @foreach ($categories as $cate )
                                        <li><a
                                                href="{{route('Category',[$cate->id, Str::slug($cate->slug)])}}">{{$cate->Category_Name}}</a>
                                        </li>
                                        @endforeach

                                    </ul>

                                    <div class="single-mega cn-col-4">
                                        <img src=" {{asset('home/img/bg-img/bg-6.jpg')}}" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{route('Home')}}">Home</a></li>
                                    <li><a href="#">Product
                                            Details</a></li>
                                    <li><a href="">Add to card</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('Checkout')}}">Check out</a></li>
                            <li><a href="{{route('userProfile')}}">User Profile</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <div class="favourite-area">
                    <a href="#"><img src=" {{asset('home/img/core-img/heart.svg')}}" alt=""></a>
                </div>
                <!-- User Login Info -->
                <div class="user-login-info">
                    <a href="#"><img src=" {{asset('home/img/core-img/user.svg')}}" alt=""></a>
                </div>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src=" {{asset('home/img/core-img/bag.svg')}}" alt="">
                        <span>{{ count((array)session('cart')) }}</span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#"  id="rightSideCart"><img src=" {{asset('home/img/core-img/bag.svg')}}"
                    alt="">
                <span>{{ count((array)session('cart')) }}</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                @php
                $total = 0;
                $totalQuantity = 0;
                @endphp

                @foreach ((array) session('cart') as $id=>$details)

                @php
                $total += $details['price'] * $details['quantity'];
                $totalQuantity += $details['quantity'];

                @endphp

                @endforeach

                @if (session('cart'))
                @foreach (session('cart') as $id=>$details )
                <div class="single-cart-item" data-id="{{$id}}" style="padding-bottom: 4px;">
                    <a href="#" class="product-image cart_remove">
                        <img src=" {{asset($details['product_img'])}}" class="cart-thumb" alt="" style="height: 268px;">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                            <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <!-- <span class="badge"></span> -->
                            <h6>{{$details['product_name']}}</h6>
                            <p class="size">Size: </p>
                            <p class="color">Số lượng: {{$details['quantity']}} cái </p>
                            <p class="price">{{number_format($details['price'],0, ',', '.')}} &#8363</p>
                        </div>
                    </a>
                </div>
                @endforeach

                @endif


                <!-- Single Cart Item -->

            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>$274.00</span></li>
                    <li id="cart-quantity"><span>Tổng số lượng:</span> <span>{{$totalQuantity}} cái</span></li>
                    <li><span>discount:</span> <span>-15%</span></li>
                    <li id="cart-total"><span>total:</span> <span>{{number_format($total,0, ',', '.')}} &#8363</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    @if($total>0)
                        <a href="{{route('Checkout')}}" class="btn essence-btn">Xác nhận thanh toán</a>

                    @else
                        <a href="#" class="btn essence-btn disabled">Chưa có đơn hàng nào</a>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->
    <div class="container">
        @if (session('success'))

        <div class="alert alert-success">
            {{session('success')}}
        </div>

        @endif
    </div>
    <!-- ##### Welcome Area Start ##### -->
    @yield('content')
    <!-- ##### Brands Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="#"><img src=" {{asset('home/img/core-img/logo2.png')}}" alt=""></a>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Subscribe</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i
                                    class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i
                                    class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                        </script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>, distributed by <a
                            href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>

        </div>
    </footer>


    <!-- ##### Footer Area End ##### -->
    <!-- ##### Modal ##### -->
    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
         aria-hidden="true" style="margin-top: 10em">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (Necessary for All JavaScript Plugins) -->



    <script src=" {{asset('home/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <script>
        $(".cart_remove").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            // Hiển thị modal xác nhận xóa sản phẩm
            $("#confirmDeleteModal").modal("show");
            // Bắt sự kiện click cho nút xác nhận trong modal
            $("#confirmDeleteButton").on("click", function() {
                $.ajax({
                    url: '{{ route('remove_cart')}}',
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: ele.parents(".single-cart-item").attr("data-id")
                    },
                    success: function(response) {
                        if (response.status) {
                            // Cập nhật số lượng sản phẩm trong giỏ hàng
                            var count = response.count;
                            $("#rightSideCart span").text(count);
                            // Cập nhật tổng giá trị giỏ hàng
                            var total = response.total;
                            $("#cart-total span:last-child").text(total);
                            // Cập nhật số lượng sản phẩm trong giỏ hàng
                            var totalQuantity = response.totalQuantity;
                            $("#cart-quantity span:last-child").text(totalQuantity + ' cái');
                            // Xóa sản phẩm khỏi danh sách giỏ hàng
                            ele.parents(".single-cart-item").remove();
                        }
                    }
                });
                // Ẩn modal sau khi xóa sản phẩm
                $("#confirmDeleteModal").modal("hide");
            });
        });

    </script>

    @yield('scripts')

    <!-- Popper js -->
    <script src=" {{asset('home/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src=" {{asset('home/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src=" {{asset('home/js/plugins.js')}}"></script>
    <!-- Classy Nav js -->
    <script src=" {{asset('home/js/classy-nav.min.js')}}"></script>
    <!-- Active js -->
    <script src=" {{asset('home/js/active.js')}}"></script>
    <script src=" {{asset('home/js/address.js')}}"></script>

</body>

</html>
