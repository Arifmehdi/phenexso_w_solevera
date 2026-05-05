            <!-- ============================================================== -->
            <!-- TOP BANNER -->
            <!-- ============================================================== -->
            <div class="top-banner">
                <a href="{{ route('shop') }}">Free and flexible 15-day exchange</a>
            </div>

            <!-- ============================================================== -->
            <!-- HEADER -->
            <!-- ============================================================== -->
            <header>
                <div class="header-inner">
                    <button class="hamburger" id="hamburgerBtn" onclick="openMobileMenu()" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>

                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo_alt()]) }}" alt="{{ $ws->name }}" style="height: 28px;" />
                    </a>

                    <div class="header-right">
                        <div class="search-box">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                            <input type="text" placeholder="Search" id="header-search-input">
                        </div>
                        <div class="header-icons">
                            <a href="#" onclick="openCart()" class="header-icon" aria-label="Shopping Cart">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                <span class="cart-count">{{ $cartCount }}</span>
                                <span class="icon-label">Cart</span>
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="header-icon" aria-label="Wish List">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                <span class="icon-label">Wish List</span>
                            </a>
                            @auth
                            <a href="{{ route('user.dashboard') }}" class="header-icon" aria-label="Account">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <span class="icon-label">Account</span>
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="header-icon" aria-label="Sign In">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <span class="icon-label">Sign In</span>
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </header>

            <!-- MOBILE OVERLAY -->
            <div class="mob-overlay" id="mobOverlay" onclick="closeMobileMenu()"></div>

            <!-- MOBILE DRAWER -->
            <div class="mobile-drawer" id="mobileDrawer">
                <button class="mob-close-btn" onclick="closeMobileMenu()" aria-label="Close menu">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
                <div class="mob-search-box">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <input type="text" placeholder="Search products...">
                </div>

                @foreach($categories ?? [] as $category)
                <div class="mob-nav-item">
                    <button class="mob-nav-link" onclick="toggleMobSub('{{ $category->slug }}')">
                        {{ $category->name_en }} 
                        @if($category->children->count() > 0)
                        <span>+</span>
                        @endif
                    </button>
                    @if($category->children->count() > 0)
                    <div class="mob-sub" id="mob-{{ $category->slug }}">
                        @foreach($category->children as $child)
                        <a href="{{ route('productCategory', $child->slug) }}">{{ $child->name_en }}</a>
                        @endforeach
                        <a href="{{ route('productCategory', $category->slug) }}" style="font-weight: 600; color: #2a8a6b;">View All {{ $category->name_en }}</a>
                    </div>
                    @endif
                </div>
                @endforeach

                <div class="mob-nav-item">
                    <a class="mob-nav-link" href="{{ route('news') }}">Blog</a>
                </div>

                <div class="mob-nav-item">
                    <a class="mob-nav-link" href="{{ route('about-us') }}">About Us</a>
                </div>

                <div class="mob-nav-item">
                    <a class="mob-nav-link" href="{{ route('contact') }}">Contact</a>
                </div>

                <div class="mob-header-actions">
                    <a href="#" onclick="openCart()" class="mob-action-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        Shopping Cart
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="mob-action-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        My Wish List
                    </a>
                    @auth
                    <a href="{{ route('user.dashboard') }}" class="mob-action-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        My Account
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="mob-action-link">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Sign In or Create Account
                    </a>
                    @endauth
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- NAVIGATION WITH MEGA MENU -->
            <!-- ============================================================== -->
            <nav>
                <div class="nav-inner">
                    <!-- <span class="nav-eid">ঈদুল আজহা ২০২৬ • EID-UL-ADHA • عيد الأضحى</span> -->

                    @foreach($categories ?? [] as $category)
                    <div class="nav-item">
                        <a href="{{ route('productCategory', $category->slug) }}" class="nav-link">{{ $category->name_en }}</a>
                        @if($category->children->count() > 0)
                        <div class="mega-menu">
                            <div class="mega-inner">
                                <div class="mega-grid">
                                    <div class="mega-col-main">
                                        <h4>Subcategories</h4>
                                        <div class="subcategory-grid">
                                            @foreach($category->children->chunk(ceil($category->children->count() / 3)) as $chunk)
                                            <ul class="mega-sub-list">
                                                @foreach($chunk as $child)
                                                <li>
                                                    <a href="{{ route('productCategory', $child->slug) }}">
                                                        {{ $child->name_en }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mega-col-featured">
                                        <div class="featured-card-modern">
                                            @if($category->image)
                                            <div class="featured-img-wrapper">
                                                <img src="{{ route('imagecache', ['template' => 'medium', 'filename' => $category->image]) }}" alt="{{ $category->name_en }}">
                                                <div class="img-overlay"></div>
                                            </div>
                                            @endif
                                            <div class="featured-info">
                                                <h5>{{ $category->name_en }} Collection</h5>
                                                <p>{{ Str::limit($category->excerpt, 80) }}</p>
                                                <a href="{{ route('productCategory', $category->slug) }}" class="modern-btn">Explore All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach

                    {{--<div class="nav-item">
                        <a href="{{ route('news') }}" class="nav-link">Blog</a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('about-us') }}" class="nav-link">About Us</a>
                    </div>

                    <div class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    </div>--}}
                </div>
            </nav>

            <style>
                /* ─── TOP BANNER ─────────────────────────────────── */
                .top-banner {
                    background: #ffffff;
                    text-align: center;
                    padding: 8px 20px;
                    font-size: 12px;
                    letter-spacing: 0.06em;
                    border-bottom: 1px solid #e8e4de;
                    font-family: 'Jost', sans-serif;
                }
                .top-banner a { color: #2a8a6b; text-decoration: none; font-weight: 500; }

                /* ─── HEADER ─────────────────────────────────────── */
                header {
                    background: #ffffff;
                    border-bottom: 1px solid #e8e4de;
                    position: sticky;
                    top: 0;
                    z-index: 1000;
                }

                .header-inner {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 0 40px;
                    height: 64px;
                    max-width: 1440px;
                    margin: 0 auto;
                }

                .logo {
                    font-family: 'Jost', sans-serif;
                    font-size: 22px;
                    font-weight: 600;
                    letter-spacing: 0.18em;
                    color: #0d0d0d;
                    text-decoration: none;
                    text-transform: uppercase;
                }

                .header-right {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                }

                .search-box {
                    display: flex;
                    align-items: center;
                    border: 1px solid #0d0d0d;
                    height: 34px;
                    padding: 0 12px;
                    gap: 8px;
                }

                .search-box input {
                    border: none;
                    outline: none;
                    font-family: 'Jost', sans-serif;
                    font-size: 12px;
                    letter-spacing: 0.04em;
                    width: 160px;
                    background: transparent;
                }

                .header-icons { display: flex; align-items: center; gap: 18px; }
                .header-icon {
                    display: flex; align-items: center; gap: 6px;
                    font-size: 11px; letter-spacing: 0.05em; cursor: pointer;
                    color: #0d0d0d; text-decoration: none;
                    white-space: nowrap;
                    position: relative;
                    font-family: 'Jost', sans-serif;
                }
                .cart-count {
                    position: absolute;
                    top: -6px; right: -8px;
                    background: #0d0d0d;
                    color: #ffffff;
                    font-size: 9px;
                    width: 16px; height: 16px;
                    border-radius: 50%;
                    display: flex; align-items: center; justify-content: center;
                }

                /* ─── NAV ─────────────────────────────────────────── */
                nav {
                    background: #0d0d0d;
                    position: relative;
                }
                .nav-inner {
                    max-width: 1440px;
                    margin: 0 auto;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 48px;
                    padding: 0 40px;
                    gap: 4px;
                    position: static; /* Important for full-width megamenu relative to nav */
                }

                .nav-eid {
                    color: #3aab87;
                    font-size: 13px;
                    letter-spacing: 0.04em;
                    margin-right: 30px;
                    font-family: 'Jost', sans-serif;
                }

                .nav-item {
                    position: static; /* Allow megamenu to reference nav for width */
                    cursor: pointer;
                }

                .nav-link {
                    color: #ffffff;
                    text-decoration: none;
                    font-size: 12px;
                    font-weight: 500;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    padding: 0 20px;
                    height: 48px;
                    display: flex;
                    align-items: center;
                    transition: color 0.2s;
                    font-family: 'Jost', sans-serif;
                }
                .nav-link:hover, .nav-link.active { color: #3aab87; }

                /* ─── MEGA MENU ───────────────────────────────────── */
                .mega-menu {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    width: 100%;
                    background: #ffffff;
                    border-top: 1px solid #e8e4de;
                    padding: 0;
                    display: none;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                    z-index: 999;
                    pointer-events: auto;
                    animation: fadeInDown 0.3s ease-out;
                }
                
                @keyframes fadeInDown {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                .nav-item:hover .mega-menu { display: block; }

                .mega-inner {
                    max-width: 1440px;
                    margin: 0 auto;
                    padding: 40px;
                }

                .mega-grid {
                    display: grid;
                    grid-template-columns: 2fr 1fr;
                    gap: 60px;
                }

                .mega-col-main h4 {
                    font-size: 11px;
                    letter-spacing: 0.15em;
                    text-transform: uppercase;
                    font-weight: 600;
                    color: #999;
                    margin-bottom: 24px;
                    padding-bottom: 12px;
                    border-bottom: 1px solid #f0f0f0;
                    font-family: 'Jost', sans-serif;
                }

                .subcategory-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 30px;
                }

                .mega-sub-list { list-style: none; padding: 0; margin: 0; }
                .mega-sub-list li { margin-bottom: 12px; }
                .mega-sub-list li a {
                    font-size: 14px;
                    color: #333;
                    text-decoration: none;
                    transition: all 0.2s;
                    font-family: 'Jost', sans-serif;
                    display: block;
                }
                .mega-sub-list li a:hover { color: #2a8a6b; transform: translateX(5px); }

                /* Modern Featured Card */
                .featured-card-modern {
                    background: #f8f8f8;
                    border-radius: 12px;
                    overflow: hidden;
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }
                .featured-img-wrapper {
                    position: relative;
                    height: 220px;
                    overflow: hidden;
                }
                .featured-img-wrapper img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
                }
                .featured-card-modern:hover .featured-img-wrapper img {
                    transform: scale(1.08);
                }
                .img-overlay {
                    position: absolute;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.2) 100%);
                }
                .featured-info {
                    padding: 24px;
                    flex-grow: 1;
                    display: flex;
                    flex-direction: column;
                }
                .featured-info h5 {
                    font-size: 18px;
                    margin-bottom: 10px;
                    color: #0d0d0d;
                    font-weight: 600;
                    font-family: 'Jost', sans-serif;
                }
                .featured-info p {
                    font-size: 14px;
                    color: #666;
                    margin-bottom: 20px;
                    line-height: 1.6;
                    font-family: 'Jost', sans-serif;
                }
                .modern-btn {
                    margin-top: auto;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    padding: 12px 24px;
                    background: #0d0d0d;
                    color: #fff !important;
                    text-decoration: none;
                    font-size: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.1em;
                    font-weight: 500;
                    transition: all 0.3s;
                    border-radius: 4px;
                }
                .modern-btn:hover { background: #2a8a6b; }

                @media (max-width: 1024px) {
                    .mega-inner { padding: 30px 20px; }
                    .mega-grid { grid-template-columns: 1fr; gap: 40px; }
                    .subcategory-grid { grid-template-columns: repeat(2, 1fr); }
                }

                @media (max-width: 1024px) {
                    .nav-eid { display: none; }
                    .mega-menu { min-width: 90vw; }
                }

                /* ─── HAMBURGER BUTTON ─── */
                .hamburger {
                    display: none;
                    flex-direction: column;
                    gap: 5px;
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 6px;
                    z-index: 1100;
                }
                .hamburger span {
                    display: block;
                    width: 22px;
                    height: 2px;
                    background: #0d0d0d;
                    transition: all 0.3s;
                }
                .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
                .hamburger.open span:nth-child(2) { opacity: 0; }
                .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

                /* ─── MOBILE DRAWER ─── */
                .mobile-drawer {
                    display: none;
                    position: fixed;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: #ffffff;
                    z-index: 1050;
                    overflow-y: auto;
                    padding: 72px 24px 40px;
                    transform: translateX(-100%);
                    transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
                }
                .mobile-drawer.open { transform: translateX(0); display: block; }

                .mob-close-btn {
                    position: absolute;
                    top: 16px;
                    right: 16px;
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 10;
                    color: #0d0d0d;
                }
                .mob-close-btn:hover { opacity: 0.6; }

                .mob-overlay {
                    display: none;
                    position: fixed;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: rgba(0,0,0,0.5);
                    z-index: 1040;
                }
                .mob-overlay.open { display: block; }

                .mob-search-box {
                    display: flex;
                    align-items: center;
                    border: 1px solid #0d0d0d;
                    height: 42px;
                    padding: 0 14px;
                    gap: 8px;
                    margin-bottom: 24px;
                }
                .mob-search-box input {
                    border: none;
                    outline: none;
                    font-family: 'Jost', sans-serif;
                    font-size: 13px;
                    width: 100%;
                    background: transparent;
                }

                .mobile-drawer .mob-nav-item { border-bottom: 1px solid #e8e4de; }
                .mobile-drawer .mob-nav-link {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 16px 0;
                    font-size: 14px;
                    font-weight: 500;
                    letter-spacing: 0.1em;
                    text-transform: uppercase;
                    color: #0d0d0d;
                    text-decoration: none;
                    cursor: pointer;
                    background: none;
                    border: none;
                    width: 100%;
                    text-align: left;
                    font-family: 'Jost', sans-serif;
                }
                .mobile-drawer .mob-sub {
                    display: none;
                    padding: 8px 0 16px;
                }
                .mobile-drawer .mob-sub.open { display: block; }
                .mobile-drawer .mob-sub a {
                    display: block;
                    padding: 8px 12px;
                    font-size: 13px;
                    color: #555555;
                    text-decoration: none;
                    letter-spacing: 0.03em;
                    font-family: 'Jost', sans-serif;
                }
                .mobile-drawer .mob-sub h4 {
                    font-size: 10px;
                    letter-spacing: 0.14em;
                    text-transform: uppercase;
                    color: #999999;
                    padding: 10px 12px 4px;
                    font-weight: 600;
                    font-family: 'Jost', sans-serif;
                }
                .mobile-drawer .mob-header-actions {
                    margin-top: 24px;
                    display: flex;
                    flex-direction: column;
                    gap: 14px;
                }
                .mobile-drawer .mob-action-link {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    font-size: 13px;
                    color: #0d0d0d;
                    text-decoration: none;
                    letter-spacing: 0.04em;
                    font-family: 'Jost', sans-serif;
                }

                /* ─── TABLET: ≤900px ─── */
                @media (max-width: 900px) {
                    .header-inner {
                        padding: 0 14px !important;
                        height: 56px !important;
                        display: grid !important;
                        grid-template-columns: 44px 1fr 132px !important;
                        align-items: center;
                    }
                    .hamburger { display: flex !important; justify-self: start !important; }
                    .logo { justify-self: center !important; text-align: center !important; }
                    .header-right { justify-self: end !important; display: flex !important; align-items: center !important; }
                    .search-box { display: none !important; }
                    .header-icons { gap: 0 !important; display: flex !important; }
                    .header-icons .header-icon { display: flex !important; }
                    .header-icons .header-icon:not(:first-child):not(:last-child) { display: none !important; }
                    nav { display: none !important; }
                }

                /* ─── MOBILE: ≤600px ─── */
                @media (max-width: 600px) {
                    .header-inner { padding: 0 10px !important; height: 52px !important; grid-template-columns: 40px 1fr 124px !important; }
                    .logo { font-size: 16px !important; letter-spacing: 0.12em !important; }
                    .header-icons .header-icon { width: 36px !important; height: 36px !important; }
                    .icon-label { display: none !important; }
                }

                @media (max-width: 768px) {
                    .search-box { display: none !important; }
                    .header-icons .header-icon span { display: none !important; }
                    .nav-eid { display: none !important; }
                    .mega-menu { display: none !important; }
                }
            </style>

            <script>
                function openMobileMenu() {
                    document.getElementById('mobileDrawer').classList.add('open');
                    document.getElementById('mobOverlay').classList.add('open');
                    document.getElementById('hamburgerBtn').classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
                function closeMobileMenu() {
                    document.getElementById('mobileDrawer').classList.remove('open');
                    document.getElementById('mobOverlay').classList.remove('open');
                    document.getElementById('hamburgerBtn').classList.remove('open');
                    document.body.style.overflow = '';
                }
                function toggleMobSub(id) {
                    const sub = document.getElementById('mob-' + id);
                    if (sub) {
                        sub.classList.toggle('open');
                    }
                }
            </script>
