<header class="header header-border">
    {{--<div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">{{ $ws->header_text ?? 'Welcome to our store!' }}</p>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <a href="#currency">BDT</a>
                </div>
                <!-- End DropDown Menu -->
                <div class="dropdown ml-5">
                    <a href="#language">ENG</a>
                </div>
                <!-- End DropDown Menu -->
                <span class="divider"></span>
                <a href="{{ route('contact') }}" class="contact d-lg-show"><i class="d-icon-map"></i>Contact</a>
                <a href="{{ route('about-us') }}" class="help d-lg-show"><i class="d-icon-info"></i> Need Help</a>
                @auth
                <a href="{{ route('user.dashboard') }}" class="login-toggle link-to-tab d-md-show"><i class="d-icon-user"></i>Dashboard</a>
                <span class="delimiter">/</span>
                <a href="{{ route('logout') }}" class="register-toggle link-to-tab d-md-show ml-0">Logout</a>
                @else
                <a href="{{ route('login') }}" class="login-toggle link-to-tab d-md-show"><i class="d-icon-user"></i>Sign in</a>
                <span class="delimiter">/</span>
                <a href="{{ route('registration') }}" class="register-toggle link-to-tab d-md-show ml-0">Register</a>
                @endauth
            </div>
        </div>
    </div>--}}
    <!-- End HeaderTop -->
    <div class="header-middle sticky-header fix-top sticky-content">
        <div class="container">
            <div class="header-left">
                <a href="#" class="mobile-menu-toggle">
                    <i class="d-icon-bars2"></i>
                </a>
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo_alt()]) }}" alt="logo" width="153" height="44" />
                </a>
                <!-- End Logo -->

                <div class="header-search hs-simple hs-expanded">
                    <form action="{{ route('search') }}" method="GET" class="input-wrapper">
                        <input type="text" class="form-control" name="parameter" id="search-input" autocomplete="off"
                            placeholder="Search..." required />
                        <button class="btn btn-search" type="submit" title="submit-button">
                            <i class="d-icon-search"></i>
                        </button>
                        <div id="search-results" class="search-results-wrapper shadow-sm" style="display: none;">
                        </div>
                    </form>
                </div>
                <!-- End Header Search -->
            </div>
            <div class="header-right">
                <style>
                    .wishlist-toggle {
                        position: relative;
                        text-decoration: none;
                    }
                    .wishlist-count {
                        position: absolute;
                        top: -8px;
                        right: -10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        min-width: 1.7rem;
                        height: 1.7rem;
                        font-size: 1rem;
                        font-family: inherit;
                        font-weight: 600;
                        line-height: 1;
                        color: #fff;
                        background-color: #27c;
                        border-radius: 50%;
                    }
                    .wishlist-toggle i {
                        font-size: 2.4rem;
                        color: #222;
                    }
                </style>
                <a href="{{ route('wishlist.index') }}" class="wishlist-toggle mr-4">
                    <i class="d-icon-heart"></i>
                    <span class="wishlist-count">{{ $wishlistCount }}</span>
                </a>
                
                <span class="divider"></span>
                <div class="dropdown cart-dropdown type2 off-canvas mr-0 mr-lg-2">
                    <a href="#" class="cart-toggle label-block link">
                        <div class="cart-label d-lg-show">
                            <span class="cart-name">Shopping Cart:</span>
                            <span class="cart-price">
                                ৳{{ number_format($cartItems->sum(function($item) {
                                    if (!$item->product) return 0;

                                    $product = $item->product;

                                    if ($product->final_price < $product->selling_price) {
                                        $price = $product->selling_price - $product->discount_price;
                                    } else {
                                        $price = $product->selling_price;
                                    }

                                    return $price * $item->quantity;
                                }), 2) }}
                            </span>
                        </div>
                        <i class="d-icon-bag"><span class="cart-count">{{ $cartCount }}</span></i>
                    </a>
                    <div class="canvas-overlay"></div>
                    <!-- End Cart Toggle -->
                    <div class="dropdown-box">
                        <div class="canvas-header">
                            <h4 class="canvas-title">Shopping Cart</h4>
                            <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close">
                                close<i class="d-icon-arrow-right"></i><span class="sr-only">Cart</span>
                            </a>
                        </div>

                        <div class="products scrollable">
                            @foreach($cartItems as $item)
                            <div class="product product-cart">
                                <figure class="product-media">
                                    <a href="{{ route('productDetails', $item->product->slug) }}">
                                        <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $item->product->fi()]) }}"
                                            alt="product" width="80" height="88" />
                                    </a>

                                    <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-link btn-close">
                                        <i class="fas fa-times"></i>
                                        <span class="sr-only">Close</span>
                                    </a>
                                </figure>

                                <div class="product-detail">
                                    <a href="{{ route('productDetails', $item->product->slug) }}" class="product-name">
                                        {{ $item->product->name_en }}
                                    </a>

                                    <div class="price-box">
                                        <span class="product-quantity">{{ $item->quantity }}</span>
                                        <span class="product-price">
                                            @php
                                                $product = $item->product;
                                                if ($product->final_price < $product->selling_price) {
                                                    $price = $product->selling_price - $product->discount_price;
                                                } else {
                                                    $price = $product->selling_price;
                                                }
                                            @endphp
                                            ৳{{ number_format($price, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Subtotal -->
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">
                                ৳{{ number_format(
                                    $cartItems->sum(function($item) {
                                        $product = $item->product;
                                        if ($product->final_price < $product->selling_price) {
                                            $price = $product->selling_price - $product->discount_price;
                                        } else {
                                            $price = $product->selling_price;
                                        }
                                        return $price * $item->quantity;
                                    }),
                                2) }}
                            </span>
                        </div>

                        <div class="cart-action">
                            <a href="{{ route('new.checkout') }}" class="btn btn-dark btn-link">View Cart</a>
                            <a href="{{ route('new.checkout') }}" class="btn btn-dark">
                                <span>Go To Checkout</span>
                            </a>
                        </div>
                    </div>
                    <!-- End Dropdown Box -->
                </div>
                <span class="divider"></span>
                <a href="{{ route('login') }}" class="icon-box icon-box-side">
                    <div class="icon-box-icon mr-0 mr-lg-2">
                        <i class="d-icon-user"></i>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <div class="header-bottom d-lg-show">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu">
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li>
                            <a href="#">Categories</a>
                            <div class="megamenu">
                                @php
                                    $catCount = $productCategories->count();
                                    $cols = 1;
                                    if ($catCount > 8) {
                                        $cols = 3;
                                    } elseif ($catCount > 4) {
                                        $cols = 2;
                                    }
                                    $colClass = 12 / $cols;
                                @endphp
                                <div class="row">
                                    @foreach($productCategories->chunk(ceil($catCount / $cols)) as $chunk)
                                    <div class="col-md-{{ $colClass }}">
                                        <h4 class="menu-title">Product Categories</h4>
                                        <ul>
                                            @foreach($chunk as $cat)
                                            <li class="mb-3">
                                                <a href="{{ route('productCategory', $cat->slug) }}" class="d-flex align-items-center">
                                                    <img src="{{ route('imagecache', ['template'=>'original','filename' => $cat->image]) }}" 
                                                         alt="{{ $cat->name_en }}" 
                                                         width="45" height="45" 
                                                         class="mr-3 rounded shadow-sm"
                                                         style="object-fit: cover; border: 1px solid #eee;">
                                                    <span style="font-weight: 500; font-size: 14px;">{{ $cat->name_en }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        @foreach($headerMenus as $menu)
                        <li>
                            <a href="{{ $menu->link }}">{{ $menu->name_en }}</a>
                        </li>
                        @endforeach
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
