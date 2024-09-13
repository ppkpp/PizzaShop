<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Title Page-->
    <title>
        @yield('title')
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="asset{{'user/css/fontawesome.min.css'}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex h-50">
            <div class="col-lg-4 h-50">
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30 text-secondary w-100">
        <div class="row px-xl-5 ">
            <div class="col-lg-4 d-none d-lg-block">
                <a href="" class="text-decoration-none ">
                    <span class="h1 text-uppercase text-primary bg-dark px-4 text-warning">
                        <img src="{{asset('image/pizza_logo-removebg-preview.png')}}" class="w-25" alt="">
                    </span>
                </a>
            </div>
            <div class="col-lg-8 mt-2 pt-3">
                <nav class="navbar w-100 navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <div class="navbar-collapse justify-content-between row" id="navbarCollapse" >
                        <div class="navbar-nav mr-auto py-0 col-8 ">
                            {{-- <a href="{{route('user#home')}}" class="nav-item nav-link"><i class="fas fa-house mr-2"></i>Home</a>
                            <a href="{{route('cart#list#page')}}" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping mr-2"></i>Cart</a>
                            <a href="{{route('contact#page')}}" class="nav-item nav-link"><i class="fa-solid fa-address-book mr-2"></i>Contact</a> --}}
                            <div class="row">
                                <div class="col-4">
                                    <a href="{{route('user#home')}}" class="nav-item nav-link"><i class="fas fa-house mr-1"></i>Home</a>
                                </div>
                                <div class="col-4">
                                    <a href="{{route('cart#list#page')}}" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping mr-2"></i>Cart</a>
                                </div>
                                <div class="col-4">
                                    <a href="{{route('contact#page')}}" class="nav-item nav-link"><i class="fa-solid fa-address-book mr-1"></i>Contact</a>
                                </div>
                                {{-- <a href="{{route('cart#list#page')}}" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping mr-2"></i> My Cart</a>
                                <a href="{{route('contact#page')}}" class="nav-item nav-link"><i class="fa-solid fa-address-book mr-2"></i>Contact</a> --}}
                            </div>
                        </div>

                        <div class="navbar-nav py-0 d-l-block offset-1 col-3">
                            <form action="{{route('logout')}}" method="post" class="d-flex justify-content-center mb-2 mt-3">
                                @csrf
                                <div class="dropdown text-warning col-4">
                                    <button class="btn btn-warning dropdown-toggle p-2 mx-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i>{{Auth::user()->name}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item my-2" href="{{route('look#profile',Auth::user()->id)}}"><i class="fa-solid fa-user-large mr-4"></i>Account</a></li>
                                        <li><a class="dropdown-item my-2" href="{{route('change#UserPassword',Auth::user()->id)}}"><i class="fa-solid fa-unlock-keyhole mr-4"></i>Change Password</a></li>
                                        <li><a class="dropdown-item" href="#">
                                            <button type="submit" class="btn bg-dark text-warning col-12">
                                                <i class="fa-solid fa-right-from-bracket mx-2 "></i>Logout
                                            </button>
                                        </a></li>
                                    </ul>
                                  </div>
                            </form>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">We'd love to hear from you! Whether you have a question, need to place an order, or just want to share your pizza love with us, feel free to reach out. Our team is here to help make your experience delicious and delightful.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>73 Street, Mandalay, Myanmar</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>pizzalandmm@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+9599000000</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="{{route('cart#list#page')}}"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="{{route('cart#list#page')}}"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="{{route('contact#page')}}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="{{route('cart#list#page')}}"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="{{route('cart#list#page')}}"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="{{route('contact#page')}}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        {{-- <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form> --}}
                        <h6 class="text-secondary text-uppercase mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('user/img/payments.png')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    {{-- JQueryCdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    {{-- <script src="{{asset('user/https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('user/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('user/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('user/js/main.js')}}"></script>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/4e03c3cb10.js" crossorigin="anonymous"></script>

</body>

@yield('scriptSource')

{{-- <script>
    $(document).ready(function () {
        $("#quantity").change(function () {
            $.ajax({
                type : 'get' ,
                url : 'http://127.0.0.1:8000/user/ajax/list/cart' ,
                data : $source ,
                dataType : 'json' ,
                success : function (response){
                    if(response.status == 'success'){
                        window.location.href = "http://127.0.0.1:8000/user/home";
                    }
                }
            });
        });
    });
</script> --}}

</html>
