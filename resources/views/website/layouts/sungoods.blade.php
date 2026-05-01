<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>@yield('title', $ws->name ?? 'Sungoods')</title>

    @yield('meta')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->favicon()]) }}">
    
    <script>
        WebFontConfig = {
            google: { families: [ 'Poppins:300,400,500,600,700,800' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = "{{ asset('sungoods/js/webfont.js') }}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/animate/animate.min.css') }}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/magnific-popup/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/vendor/sticky-icon/stickyicon.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('sungoods/css/demo1.min.css') }}">
    
    @stack('css')
    <style>
        /* Wishlist Icon Red Style */
        .add-to-wishlist i, .btn-wishlist i {
            color: #e32937 !important;
        }
        
        .search-results-wrapper {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #eee;
            border-top: none;
            border-radius: 0 0 4px 4px;
        }
        .search-result-item {
            padding: 10px;
            border-bottom: 1px solid #f5f5f5;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none !important;
        }
        .search-result-item:hover {
            background: #f9f9f9;
        }
        .search-result-item:last-child {
            border-bottom: none;
        }
        .search-result-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 4px;
        }
        .search-result-item .info {
            flex: 1;
        }
        .search-result-item .name {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 2px;
        }
        .search-result-item .price {
            font-size: 13px;
            color: #222;
            font-weight: 600;
        }
        .no-results {
            padding: 15px;
            text-align: center;
            color: #999;
            font-size: 14px;
        }
    </style>
</head>

<body class="@yield('body_class', 'home')">

    <div class="page-wrapper">
        @include('website.layouts.sungoods_header')

        <main class="main">
            @yield('content')
        </main>
        <!-- End Main -->

        @include('website.layouts.sungoods_footer')
    </div>

    <!-- Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="{{ route('home') }}" class="sticky-link active">
            <i class="d-icon-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('shop') }}" class="sticky-link">
            <i class="d-icon-volume"></i>
            <span>Categories</span>
        </a>
        <a href="{{ route('wishlist.index') }}" class="sticky-link">
            <i class="d-icon-heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="{{ route('change.profile') }}" class="sticky-link">
            <i class="d-icon-user"></i>
            <span>Account</span>
        </a>
        <div class="header-search hs-toggle directory">
            <a href="#" class="search-toggle sticky-link">
                <i class="d-icon-search"></i>
                <span>Search</span>
            </a>
            <form action="{{ route('search') }}" method="GET" class="input-wrapper">
                <input type="text" class="form-control mobile-search-input" name="parameter" placeholder="Search your keyword..."
                    required autocomplete="off" />
                <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                </button>
                <div class="search-results-wrapper shadow-sm mobile-search-results" style="display: none;">
                </div>
            </form>
        </div>
    </div>
    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="d-icon-arrow-up"></i></a>

    <!-- MobileMenu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay">
        </div>
        <!-- End of Overlay -->
        <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
        <!-- End of CloseButton -->
        <div class="mobile-menu-container scrollable">
            <form action="{{ route('search') }}" method="GET" class="input-wrapper">
                <input type="text" class="form-control mobile-search-input" name="parameter" placeholder="Search your keyword..."
                    required autocomplete="off" />
                <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                </button>
                <div class="search-results-wrapper shadow-sm mobile-search-results" style="display: none;">
                </div>
            </form>
            <!-- End of Search Form -->
            <ul class="mobile-menu mmenu-anim">
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a href="#">Categories</a>
                    <ul>
                        @foreach($productCategories as $cat)
                        <li>
                            <a href="{{ route('productCategory', $cat->slug) }}" class="d-flex align-items-center py-2">
                                <img src="{{ route('imagecache', ['template' => 'thumbnail', 'filename' => $cat->fi()]) }}" 
                                     alt="{{ $cat->name_en }}" 
                                     width="30" height="30" 
                                     class="mr-3 rounded shadow-sm"
                                     style="object-fit: cover; border: 1px solid #eee;">
                                {{ $cat->name_en }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('shop') }}">Products</a>
                </li>
                <li>
                    <a href="{{ route('about-us') }}">About Us</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </li>
            </ul>
            <!-- End of MobileMenu -->
        </div>
    </div>

    <!-- Plugins JS File -->
    <script src="{{ asset('sungoods/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/sticky/sticky.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/elevatezoom/jquery.elevatezoom.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('sungoods/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('sungoods/js/main.min.js') }}"></script>

    @include('sweetalert::alert')

    <script>
        $(document).on("click", ".add-to-cart-btn", function (e) {
            e.preventDefault();
            let id = $(this).data("id");
            let qty = $(this).closest('.product-form-group').find('.quantity').val() || 1;

            $.ajax({
                url: "{{ route('cart.quick.add') }}",
                type: "GET",
                data: { id: id, quantity: qty },
                success: function (res) {
                    if (typeof Riode !== 'undefined' && Riode.Minipopup) {
                        Riode.Minipopup.open({
                            message: 'Successfully added to cart',
                            productClass: ' product-cart',
                            name: res.name,
                            nameLink: "{{ route('productDetails', '') }}/" + res.slug,
                            imageSrc: res.image,
                            imageLink: "{{ route('productDetails', '') }}/" + res.slug,
                            price: '৳' + res.price,
                            count: qty,
                            actionTemplate: '<div class="action-group d-flex mt-3"><a href="{{ route("new.checkout") }}" class="btn btn-sm btn-outline btn-primary btn-rounded mr-2">View Cart</a><a href="{{ route("new.checkout") }}" class="btn btn-sm btn-primary btn-rounded">Check Out</a></div>'
                        });
                    }
                    
                    if(res.cartCount !== undefined) {
                        $(".cart-count").text(res.cartCount);
                    }
                    if(res.cartTotal !== undefined) {
                        $(".cart-price").text('৳' + parseFloat(res.cartTotal).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    }
                    if(res.cartDropdownHtml) {
                        $(".cart-dropdown .dropdown-box").html(res.cartDropdownHtml);
                    }
                }
            });
        });

        $(document).on("click", ".cart-dropdown .btn-close", function (e) {
            e.preventDefault();
            let removeUrl = $(this).attr('href');
            
            $.ajax({
                url: removeUrl,
                type: "GET",
                success: function (res) {
                    if(res.cartCount !== undefined) {
                        $(".cart-count").text(res.cartCount);
                    }
                    if(res.cartTotal !== undefined) {
                        $(".cart-price").text('৳' + parseFloat(res.cartTotal).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    }
                    if(res.cartDropdownHtml) {
                        $(".cart-dropdown .dropdown-box").html(res.cartDropdownHtml);
                    }
                }
            });
        });

        $(document).on('click', '.add-to-wishlist', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "{{ route('wishlist.add') }}",
                type: "POST",
                data: {
                    product_id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if(res.status == 'success') {
                        $(".wishlist-count").text(res.wishlistCount);
                    }
                    // Check if theme has its own popup for wishlist or use simple alert
                    if (typeof Riode !== 'undefined' && Riode.Minipopup) {
                        Riode.Minipopup.open({
                            message: res.message,
                            productClass: ' product-cart',
                            name: 'Wishlist Update',
                            actionTemplate: '<div class="action-group d-flex mt-3"><a href="{{ route("wishlist.index") }}" class="btn btn-sm btn-primary btn-rounded">View Wishlist</a></div>'
                        });
                    } else {
                        alert(res.message);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let searchTimer;
            const $searchInput = $('#search-input');
            const $searchResults = $('#search-results');
            const $mobileSearchInputs = $('.mobile-search-input');

            function performSearch(query, $container) {
                if (query.length < 2) {
                    $container.hide().empty();
                    return;
                }

                $.ajax({
                    url: "{{ route('search.ajax') }}",
                    data: { parameter: query },
                    success: function(data) {
                        $container.empty();
                        if (data.length > 0) {
                            data.forEach(function(product) {
                                $container.append(`
                                    <a href="${product.url}" class="search-result-item">
                                        <img src="${product.image}" alt="${product.name}">
                                        <div class="info">
                                            <span class="name">${product.name}</span>
                                            <span class="price">${product.price_html}</span>
                                        </div>
                                    </a>
                                `);
                            });
                            $container.show();
                        } else {
                            $container.append('<div class="no-results">No products found</div>');
                            $container.show();
                        }
                    }
                });
            }

            $searchInput.on('input', function() {
                clearTimeout(searchTimer);
                const query = $(this).val();
                searchTimer = setTimeout(function() {
                    performSearch(query, $searchResults);
                }, 300);
            });

            $mobileSearchInputs.on('input', function() {
                clearTimeout(searchTimer);
                const query = $(this).val();
                const $container = $(this).siblings('.search-results-wrapper');
                searchTimer = setTimeout(function() {
                    performSearch(query, $container);
                }, 300);
            });

            // Close results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.header-search').length) {
                    $('.search-results-wrapper').hide();
                }
            });
        });
    </script>

    @stack('js')
    
</body>

</html>
