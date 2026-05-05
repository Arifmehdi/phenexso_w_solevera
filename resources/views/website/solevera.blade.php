@extends('website.layouts.solevera')

@section('content')

<style>
  /* ─── LABORATORY DESIGN STYLES ─────────────────────────── */
  :root {
    --black: #0d0d0d;
    --white: #ffffff;
    --cream: #f7f4ef;
    --accent: #2a8a6b;
    --accent-light: #3aab87;
    --gray-light: #e8e4de;
    --gray-mid: #999;
    --gray-dark: #555;
    --font-display: 'Cormorant Garamond', serif;
    --font-body: 'Jost', sans-serif;
  }

  .hero-section {
    position: relative;
    width: 100%;
    aspect-ratio: 16/7;
    overflow: hidden;
    background: #1a1a1a;
    margin: 0;
    padding: 0;
  }

  .hero-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1.2s ease;
    display: flex;
    align-items: center;
    justify-content: flex-end;
  }
  .hero-slide.active { opacity: 1; }

  .slide-bg {
    position: absolute;
    inset: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
  }

  .slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);
  }

  .slide-content {
    position: absolute;
    left: 8%;
    top: 50%;
    transform: translateY(-50%);
    max-width: 460px;
    color: var(--white);
    z-index: 2;
  }

  .slide-eyebrow {
    font-size: 11px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--accent-light);
    margin-bottom: 14px;
    font-family: var(--font-body);
    font-weight: 500;
  }

  .slide-title {
    font-family: var(--font-display);
    font-size: clamp(32px, 4vw, 56px);
    font-weight: 300;
    line-height: 1.2;
    margin-bottom: 10px;
    font-style: italic;
  }

  .slide-sub {
    font-size: 13px;
    letter-spacing: 0.06em;
    color: rgba(255,255,255,0.8);
    margin-bottom: 28px;
    line-height: 1.6;
  }

  .btn-hero {
    display: inline-block;
    padding: 12px 32px;
    background: transparent;
    border: 1px solid var(--white);
    color: var(--white);
    font-size: 11px;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    text-decoration: none;
    font-family: var(--font-body);
    transition: background 0.3s, color 0.3s;
    cursor: pointer;
  }
  .btn-hero:hover { background: var(--white); color: var(--black); }

  .slide-brand {
    position: absolute;
    right: 6%;
    bottom: 10%;
    font-family: var(--font-display);
    font-size: clamp(48px, 7vw, 96px);
    color: rgba(255,255,255,0.12);
    font-weight: 600;
    letter-spacing: 0.04em;
    pointer-events: none;
  }

  .hero-dots {
    position: absolute;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
  }
  .hero-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
    cursor: pointer;
    border: none;
    transition: background 0.3s, transform 0.3s;
  }
  .hero-dot.active { background: var(--white); transform: scale(1.3); }

  /* ─── GRADIENT SLIDES ─────────────────────────── */
  .slide-grad-1 { background: linear-gradient(135deg, #1c2a38 0%, #2d4a3e 50%, #1a3028 100%); }
  .slide-grad-2 { background: linear-gradient(135deg, #2c1a1a 0%, #4a2d20 50%, #3d1f0f 100%); }
  .slide-grad-3 { background: linear-gradient(135deg, #1a1c2a 0%, #2d2040 50%, #1a1535 100%); }

  /* ─── SECTION TITLE ──────────────────────────── */
  .section-header {
    text-align: center;
    padding: 52px 20px 32px;
  }
  .section-label {
    font-size: 10px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--accent);
    font-weight: 600;
    margin-bottom: 10px;
  }
  .section-title {
    font-family: var(--font-display);
    font-size: clamp(28px, 3vw, 40px);
    font-weight: 300;
    font-style: italic;
    letter-spacing: 0.02em;
  }
  .section-divider {
    width: 48px;
    height: 1px;
    background: var(--accent);
    margin: 14px auto 0;
  }

  /* ─── CATEGORIES GRID ────────────────────────── */
  .categories-grid {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 40px 60px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
  }

  .cat-card {
    position: relative;
    overflow: hidden;
    aspect-ratio: 3/4;
    cursor: pointer;
    background: var(--gray-light);
    display: flex;
    align-items: flex-end;
    text-decoration: none;
  }
  .cat-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 50%);
    transition: opacity 0.4s;
  }
  .cat-card:hover::after { opacity: 0.8; }

  .cat-card-bg {
    position: absolute;
    inset: 0;
    width: 100%; 
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease;
  }
  .cat-card:hover .cat-card-bg { transform: scale(1.06); }

  .cat-label {
    position: absolute;
    bottom: 20px;
    left: 20px;
    z-index: 1;
    color: var(--white);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
  }

  /* ─── CATEGORY COLORS ────────────────────────── */
  .cat-1 { background: linear-gradient(135deg, #2c3e30, #4a6350); }
  .cat-2 { background: linear-gradient(135deg, #3a2c1a, #6b4e2e); }
  .cat-3 { background: linear-gradient(135deg, #1a3040, #2d5068); }
  .cat-4 { background: linear-gradient(135deg, #2a1a2a, #4a2d4a); }
  .cat-5 { background: linear-gradient(135deg, #1a2a3a, #2d4a6a); }
  .cat-6 { background: linear-gradient(135deg, #2a2a1a, #4a4a2d); }
  .cat-7 { background: linear-gradient(135deg, #3a2020, #6a3030); }
  .cat-8 { background: linear-gradient(135deg, #1a1a2a, #2d2d4a); }

  /* ─── PRODUCTS GRID ────────────────────────────────── */
  .products-section {
    max-width: 1440px;
    margin: 0 auto;
    padding: 32px 40px 60px;
  }

  .product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px 16px;
  }

  .product-card {
    cursor: pointer;
    position: relative;
  }
  .product-card:hover .product-img-wrap img { transform: scale(1.04); }

  .product-img-wrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 3/4;
    background: var(--cream);
    margin-bottom: 12px;
  }
  .product-img-wrap img {
    width: 100%; 
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }

  .product-badge {
    position: absolute;
    top: 10px; 
    left: 10px;
    background: var(--accent);
    color: var(--white);
    font-size: 9px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 4px 8px;
    font-weight: 600;
    z-index: 3;
  }

  .product-actions {
    position: absolute;
    bottom: 12px; 
    right: 12px;
    display: flex; 
    flex-direction: column; 
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 3;
  }
  .product-card:hover .product-actions { opacity: 1; }
  
  .action-btn {
    width: 34px; 
    height: 34px;
    background: var(--white);
    border: none;
    display: flex; 
    align-items: center; 
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    transition: background 0.2s;
    color: var(--black);
    font-size: 14px;
    padding: 0;
  }
  .action-btn:hover { background: var(--black); color: var(--white); }

  .product-name {
    font-size: 12px;
    letter-spacing: 0.03em;
    color: var(--black);
    margin-bottom: 5px;
    line-height: 1.4;
  }
  
  .product-name a {
    color: var(--black);
    text-decoration: none;
  }
  
  .product-name a:hover {
    color: var(--accent);
  }

  .product-price {
    font-size: 13px;
    font-weight: 500;
    color: var(--black);
    letter-spacing: 0.02em;
  }
  .product-price .old-price {
    text-decoration: line-through;
    color: var(--gray-mid);
    font-weight: 400;
    font-size: 11px;
    margin-left: 6px;
  }

  @media (max-width: 1024px) {
    .categories-grid { grid-template-columns: repeat(2, 1fr); padding: 0 20px 40px; }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 768px) {
    .categories-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; padding: 0 16px 40px; }
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 20px 10px; }
    .products-section { padding: 20px 16px 50px; }
    .slide-content { left: 16px; max-width: 80%; }
    .hero-section { aspect-ratio: 16/9; }
    .section-header { padding: 40px 16px 24px; }
    .cat-label { font-size: 11px; bottom: 12px; left: 12px; }
    .product-name { font-size: 11px; }
    .product-price { font-size: 12px; }
  }
</style>

<!-- ============================ HERO SLIDER ================================== -->
<section class="hero-section">
  @forelse($sliders as $index => $slider)
  <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
    <div class="slide-grad-{{ ($index % 3) + 1 }}" style="position:absolute;inset:0;"></div>
    <div class="slide-overlay"></div>
    <img src="{{ route('imagecache', ['template'=>'original','filename' => $slider->fi()]) }}" alt="{{ $slider->title }}" class="slide-bg">
    <div class="slide-content">
      <div class="slide-eyebrow">{{ $slider->category ?? 'Collection' }}</div>
      <div class="slide-title">{!! $slider->title !!}</div>
      <div class="slide-sub">{{ $slider->description }}</div>
      @if($slider->link)
      <a href="{{ $slider->link }}" class="btn-hero">Shop Now</a>
      @endif
    </div>
    <div class="slide-brand">SOLEVERA</div>
  </div>
  @empty
  <div class="hero-slide active">
    <div class="slide-grad-1" style="position:absolute;inset:0;"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-eyebrow">Welcome</div>
      <div class="slide-title">Discover Our Collections</div>
      <div class="slide-sub">Premium quality products for you</div>
      <a href="#" class="btn-hero">Explore</a>
    </div>
    <div class="slide-brand">SOLEVERA</div>
  </div>
  @endforelse

  <div class="hero-dots">
    @foreach($sliders as $index => $slider)
    <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></button>
    @endforeach
  </div>
</section>

<!-- ============================ TOP CATEGORIES ================================== -->
<div class="section-header">
  <div class="section-label">Explore</div>
  <div class="section-title">Top Categories</div>
  <div class="section-divider"></div>
</div>

<div class="categories-grid">
  @foreach($categories as $index => $category)
  <a href="{{ route('productCategory', $category->slug) }}" class="cat-card cat-{{ (($index % 8) + 1) }}">
    <img src="{{ route('imagecache', ['template'=>'original','filename' => $category->fi()]) }}" alt="{{ $category->name_en }}" class="cat-card-bg">
    <div class="cat-label">{{ $category->name_en }}</div>
  </a>
  @endforeach
</div>

<!-- ============================ FEATURED PRODUCTS ================================== -->
<div class="section-header">
  <div class="section-label">Featured</div>
  <div class="section-title">Our Best Sellers</div>
  <div class="section-divider"></div>
</div>

<div class="products-section">
  <div class="product-grid">
    @forelse($feature_products as $product)
    <div class="product-card">
      <div class="product-img-wrap">
        @if($product->discount_price > 0)
        <div class="product-badge">Sale</div>
        @endif
        <img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}">
        <div class="product-actions">
          <button class="action-btn quick-view-btn" data-id="{{ $product->id }}" title="Quick View"><i class="fas fa-eye"></i></button>
          <button class="action-btn add-to-cart-btn" data-id="{{ $product->id }}" title="Add to Cart"><i class="fas fa-shopping-basket"></i></button>
          <button class="action-btn add-to-wishlist" data-id="{{ $product->id }}" title="Add to Wishlist"><i class="far fa-heart"></i></button>
        </div>
      </div>
      <div class="product-name">
        <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
      </div>
      <div class="product-price">
        ৳{{ $product->selling_price }}
        @if($product->discount_price > 0)
        <span class="old-price">৳{{ $product->cost_price }}</span>
        @endif
      </div>
    </div>
    @empty
    <p style="grid-column: 1/-1; text-align: center; color: #999; padding: 40px;">No featured products available</p>
    @endforelse
  </div>
</div>

<!-- ============================ CATEGORY PRODUCTS LOOP ================================== -->
{{--@foreach($categories as $category)
  @if($category->products->count() > 0)
  <div class="section-header">
    <div class="section-label">{{ $category->name_en }}</div>
    <div class="section-title">Discover {{ $category->name_en }}</div>
    <div class="section-divider"></div>
  </div>

  <div class="products-section">
    <div class="product-grid">
      @foreach($category->products->take(8) as $product)
      <div class="product-card">
        <div class="product-img-wrap">
          @if($product->discount_price > 0)
          <div class="product-badge">Sale</div>
          @endif
          <img src="{{ route('imagecache', ['template'=>'original','filename' => $product->fi()]) }}" alt="{{ $product->name_en }}">
          <div class="product-actions">
            <button class="action-btn quick-view-btn" data-id="{{ $product->id }}" title="Quick View"><i class="fas fa-eye"></i></button>
            <button class="action-btn add-to-cart-btn" data-id="{{ $product->id }}" title="Add to Cart"><i class="fas fa-shopping-basket"></i></button>
            <button class="action-btn add-to-wishlist" data-id="{{ $product->id }}" title="Add to Wishlist"><i class="far fa-heart"></i></button>
          </div>
        </div>
        <div class="product-name">
          <a href="{{ route('productDetails', $product->slug) }}">{{ $product->name_en }}</a>
        </div>
        <div class="product-price">
          ৳{{ $product->selling_price }}
          @if($product->discount_price > 0)
          <span class="old-price">৳{{ $product->cost_price }}</span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    <div style="text-align: center; margin-top: 40px;">
      <a href="{{ route('productCategory', $category->slug) }}" class="btn-hero" style="color: var(--black); border-color: var(--black);">View All {{ $category->name_en }}</a>
    </div>
  </div>
  @endif
@endforeach--}}

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.hero-slide');
  const dots = document.querySelectorAll('.hero-dot');

  function showSlide(n) {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    if (n >= slides.length) currentSlide = 0;
    if (n < 0) currentSlide = slides.length - 1;
    
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
  }

  function goToSlide(n) {
    currentSlide = n;
    showSlide(currentSlide);
  }

  function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
  }

  // Auto-advance slides every 6 seconds
  if (slides.length > 1) {
    setInterval(nextSlide, 6000);
  }
</script>

@endsection

