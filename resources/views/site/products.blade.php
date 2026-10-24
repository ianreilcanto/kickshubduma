<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#172f40">
  <title>Products | Kicks Hub Duma</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('site/products/styles.css') }}">
</head>
<body>
  <div class="announcement">
    <span>{{ $c['announcement_title'] }}</span>
    <span>{{ $c['announcement_text'] }}</span>
  </div>
  <header class="site-header">
    <a class="brand" href="{{ route('home') }}" aria-label="Kicks Hub Duma home">
      <div class="brand-mark"><span>KH</span><b>D</b></div>
      <span class="brand-copy"><strong>KICKS HUB DUMA</strong><small>YOUR LOCAL SPORTS CLUB</small></span>
    </a>
    <button class="menu-toggle" id="menuToggle" aria-label="Open menu" aria-expanded="false">☰</button>
    <nav class="main-nav" id="mainNav">
      <a href="{{ route('home') }}">Home</a><a class="active" href="{{ route('products') }}">Products</a><a href="{{ route('about') }}">About</a><a href="{{ route('athletes') }}">Our Athletes</a>
    </nav>
    <div class="header-tools">
      <button class="icon-button" id="searchToggle" aria-label="Search products"><svg viewBox="0 0 24 24"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/></svg></button>
      <button class="icon-button" aria-label="Account"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c.7-4.1 3.4-6.2 8-6.2s7.3 2.1 8 6.2"/></svg></button>
      <button class="bag-button" id="bagButton" aria-label="Shopping bag"><svg viewBox="0 0 24 24"><path d="M5 8h14l1 13H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg><span>Bag (<b id="bagCount">0</b>)</span></button>
    </div>
  </header>

  <main>
    <section class="intro">
      <div class="intro-copy">
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span><strong>Products</strong></div>
        <p class="eyebrow">{{ $c['intro_eyebrow'] }}</p>
        <h1>{!! nl2br(e($c['intro_title'])) !!}</h1>
        <p class="intro-subtitle">{!! nl2br(e($c['intro_subtitle'])) !!}</p>
      </div>
      <div class="intro-art" aria-label="Editorial sneaker artwork">
        <div class="art-stamp">LOCAL<br><strong>{{ $c['art_stamp_main'] }}</strong><br>SUPPLY</div>
        <div class="shoe shoe-large"><span class="shoe-sole"></span><span class="shoe-upper"></span><span class="shoe-detail"></span><span class="shoe-laces"></span></div>
        <span class="art-note">{{ $c['art_note'] }}</span>
      </div>
    </section>

    <section class="category-bar" id="catalogue" aria-label="Product categories">
      <button class="category active" data-category="all">All gear <small>{{ str_pad($products->count(), 2, '0', STR_PAD_LEFT) }}</small></button>
      @foreach ($categories as $category)
      <button class="category" data-category="{{ $category->slug }}">{{ $category->name }} <small>{{ str_pad($category->shown_count, 2, '0', STR_PAD_LEFT) }}</small></button>
      @endforeach
      <label class="store-search"><svg viewBox="0 0 24 24"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/></svg><input id="searchInput" type="search" placeholder="Search the store" aria-label="Search the store"></label>
    </section>

    <section class="catalogue-layout">
      <aside class="filters" aria-label="Product filters">
        <div class="filter-top"><strong>Filters</strong><button id="clearFilters">Clear all</button></div>
        <div class="filter-group">
          <button class="filter-heading" aria-expanded="true">ACTIVITY <span>−</span></button>
          @foreach ($activities as $activity => $count)
          <label><input type="checkbox" value="{{ $activity }}" data-filter="activity"> {{ $activity }} <small>{{ $count }}</small></label>
          @endforeach
        </div>
        <div class="filter-group">
          <button class="filter-heading" aria-expanded="true">SIZE <span>−</span></button>
          <div class="size-options">
            <button data-size="6">6</button><button data-size="7">7</button><button data-size="8">8</button><button data-size="9">9</button><button data-size="10">10</button><button data-size="11">11</button>
          </div>
        </div>
        <div class="filter-group">
          <button class="filter-heading" aria-expanded="true">PRICE RANGE <span>−</span></button>
          <div class="price-label"><span>₱1,000</span><span>₱{{ number_format($maxPrice) }}</span></div>
          <input id="priceRange" type="range" min="1000" max="{{ $maxPrice }}" step="250" value="{{ $maxPrice }}">
          <p class="range-value">Up to <strong id="priceValue">₱{{ number_format($maxPrice) }}</strong></p>
        </div>
        <div class="filter-note"><span class="filter-note-icon">✳</span><p><strong>{{ $c['filter_note_title'] }}</strong><br>{{ $c['filter_note_text'] }}</p></div>
      </aside>

      <div class="product-area">
        <div class="results-bar"><span><strong id="resultCount">{{ $products->count() }}</strong> products shown</span><label>Sort by <select id="sortSelect"><option value="featured">Featured</option><option value="price-low">Price: low to high</option><option value="price-high">Price: high to low</option><option value="name">Name A–Z</option></select></label></div>
        <div class="product-grid" id="productGrid">
          @foreach ($products as $product)
          @php
            $slug = $product->category?->slug;
            $first = $loop->first;
            $visual = match ($slug) { 'paddle' => 'visual-paddle', 'kits' => 'visual-kit', default => ['visual-red', 'visual-sand', 'visual-blue', 'visual-olive', 'visual-street'][$loop->index % 5] };
          @endphp
          <article class="product-card" data-name="{{ $product->name }}" data-category="{{ $slug }}" data-activity="{{ $product->activity }}" data-price="{{ (int) $product->price }}" data-sizes="{{ implode(',', $product->sizes ?? []) }}" data-order="{{ $loop->iteration }}">
            <div class="product-visual {{ $visual }}">@if ($product->badge)<span class="product-badge">{{ $product->badge }}</span>@endif<button class="favorite" aria-label="Add {{ $product->name }} to favorites">♡</button>@if (! empty($product->images))<img src="{{ asset('storage/'.$product->images[0]) }}" alt="{{ $product->name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0">@elseif ($slug === 'paddle')<div class="paddle-art"><span></span></div>@elseif ($slug === 'kits')<div class="kit-art"><span class="kit-shirt"></span><span class="kit-shorts"></span></div>@else<div class="shoe product-shoe"><span class="shoe-sole"></span><span class="shoe-upper"></span><span class="shoe-detail"></span><span class="shoe-laces"></span></div>@endif<span class="visual-code">{{ $product->sku }}</span></div>
            <div class="product-meta"><div class="product-title-row"><h3>{{ $product->name }}</h3><strong>₱{{ number_format($product->price) }}</strong></div><p>{{ $product->description }}{{ $product->color ? ' · '.$product->color : '' }}</p><div class="product-bottom"><div class="swatches"><i class="navy"></i><i class="cream"></i></div><button class="quick-add">Quick add <span>＋</span></button></div></div>
          </article>
          @endforeach
        </div>
        <div class="empty-state" id="emptyState" hidden><span>✳</span><h3>{{ $c['empty_title'] }}</h3><p>{{ $c['empty_text'] }}</p><button id="emptyReset">Clear filters</button></div>
        <div class="catalogue-footer"><span>{{ $c['catalogue_footer'] }}</span><button id="loadMore">LOAD MORE PRODUCTS <span>＋</span></button></div>
      </div>
    </section>

    <section class="help-banner" id="about"><div class="help-symbol">KHD<br><span>✳</span></div><div><p class="eyebrow">{{ $c['help_eyebrow'] }}</p><h2>{!! nl2br(e($c['help_title'])) !!}</h2><p>{{ $c['help_text'] }}</p></div><a href="mailto:{{ $c['contact_email'] }}" class="button-light">{{ $c['help_button'] }} <span>↗</span></a></section>
  </main>

  <footer class="site-footer">
    <div class="footer-main"><div class="footer-brand"><div class="brand-mark footer-mark"><span>KH</span><b>D</b></div><p>Local roots. Everyday movement.<br>Gear for the game you love.</p><div class="socials"><a href="#" aria-label="Instagram">◎</a><a href="#" aria-label="Facebook">f</a><span>@@kickshubduma</span></div></div>
      <div class="footer-column"><h4>THE STORE</h4><a href="{{ route('products') }}">Shop all</a><a href="{{ route('products') }}">Shoes</a><a href="{{ route('products') }}">Paddles</a><a href="{{ route('products') }}">Training kits</a></div>
      <div class="footer-column"><h4>NEED A HAND?</h4><a href="#">Size guide</a><a href="#">Shipping & returns</a><a href="#">FAQs</a><a href="mailto:hello@kickshubduma.example">Contact us</a></div>
      <div class="footer-column"><h4>THE CLUB</h4><a href="{{ route('about') }}">Our story</a><a href="{{ route('athletes') }}">Our athletes</a><a href="#">Community</a><a href="#">Journal</a></div>
    </div>
    <div class="footer-bottom"><span>{{ $c['footer_copyright'] }}</span><span>Privacy · Terms · Payments</span><span>PHILIPPINES · PHP ₱</span></div>
  </footer>
  <div class="toast" id="toast" role="status" aria-live="polite"></div>
  <script src="{{ asset('site/products/script.js') }}"></script>
</body>
</html>
