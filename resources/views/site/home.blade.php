<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kicks Hub Duma — Good Kicks. Real Game. Local Soul.</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('site/home/styles.css') }}">
</head>
<body>
<div class="announcement"><strong>DUMAGUETE ROOTS. EVERYDAY MOVEMENT.</strong><span>Free PH shipping on orders ₱5,000+ · Find your next pair →</span></div>
<header class="header">
  <a class="brand" href="{{ route('home') }}" aria-label="Kicks Hub Duma home">
    <div class="logo-mark"><span>KH</span><small>DUMA</small></div>
    <div><b>KICKS HUB DUMA</b><small>YOUR LOCAL SPORTS CLUB</small></div>
  </a>
  <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
  <nav class="nav"><a class="active" href="{{ route('home') }}">Home</a><a href="{{ route('products') }}">Products</a><a href="{{ route('about') }}">About</a><a href="{{ route('athletes') }}">Our Athletes</a></nav>
  <div class="tools"><button aria-label="Search" id="searchBtn">⌕</button><button aria-label="Account">♙</button><button class="bag" id="bagBtn">♧ <span>Bag (<i id="bagCount">0</i>)</span></button></div>
</header>
<main id="home">
<section class="hero">
  <div class="hero-copy">
    <p class="eyebrow">THE DUMA EDIT / VOL. 01 — 2026</p>
    <h1>GOOD KICKS.<br>REAL GAME.<br><em>LOCAL SOUL.</em></h1>
    <div class="intro"><p>From the first lace-up to the last point. Find shoes, paddle gear and kits that move with you. Rooted in Dumaguete. Ready for anywhere.</p>
      <div class="actions"><a class="btn primary" href="{{ route('products') }}">SHOP SHOES <span>↗</span></a><a class="btn outline" href="{{ route('products') }}">EXPLORE THE STORE</a></div>
    </div>
    <p class="hero-note">COURT CLASSICS. EVERYDAY ROTATION.</p>
  </div>
  <div class="hero-visual">
    <div class="photo-placeholder hero-photo" role="img" aria-label="Editorial sneaker photograph"><div class="shoe-shape"></div><div class="photo-caption">THE EVERYDAY STARTING FIVE</div></div>
    <div class="seal"><small>BUILT FOR</small><strong>THE GAME</strong><small>&amp; THE EVERYDAY</small></div>
    <div class="feature-caption"><div><b>Baseline 01 — Varsity Red</b><span>A new classic for your rotation. / ₱4,250</span></div><a href="{{ route('products') }}" aria-label="View featured shoe">↗</a></div>
  </div>
</section>
<div class="ribbon"><span>FOR THE LOVE OF THE GAME　 +</span><span>KICKS HUB DUMA　 +</span><span>FROM OUR CITY. FOR YOUR NEXT MOVE.　 +</span><span>KICKS HUB DUMA　 +</span></div>
<section class="assurances">
  <div><span class="assurance-icon">↗</span><p><b>PH-WIDE DELIVERY</b><small>Free shipping on orders ₱5,000+</small></p></div>
  <div><span class="assurance-icon">▣</span><p><b>AUTHENTIC PICKS</b><small>Gear picked for your game</small></p></div>
  <div><span class="assurance-icon">↻</span><p><b>LOCAL SUPPORT</b><small>Real people, right here in Duma</small></p></div>
  <div><span class="assurance-icon">⌖</span><p><b>ROOTED IN DUMAGUETE</b><small>Made for our local community</small></p></div>
</section>
<section class="section categories" id="products">
  <div class="section-heading"><div><p class="eyebrow">FIND YOUR NEXT MOVE</p><h2>GEAR UP. <em>GET OUT THERE.</em></h2></div><a class="text-link" href="{{ route('products') }}">VIEW ALL PRODUCTS ↗</a></div>
  <div class="category-grid">
    <a class="category-card cat-shoes" href="{{ route('products') }}"><div class="category-art sneaker-art"></div><span>01 / FOOTWEAR</span><h3>SHOES THAT<br>SHOW UP.</h3><b>SHOP SHOES ↗</b></a>
    <a class="category-card cat-court" href="{{ route('products') }}"><div class="category-art paddle-art"></div><span>02 / COURT GEAR</span><h3>OWN YOUR<br>COURT.</h3><b>SHOP COURT GEAR ↗</b></a>
    <a class="category-card cat-apparel" href="{{ route('products') }}"><div class="category-art apparel-art"></div><span>03 / APPAREL</span><h3>MADE TO<br>MOVE.</h3><b>SHOP APPAREL ↗</b></a>
  </div>
</section>
<section class="section product-section" id="shop-grid">
  <div class="section-heading"><div><p class="eyebrow">THE LOCAL ROTATION</p><h2>GOOD THINGS. <em>GOOD GAME.</em></h2></div><div class="filters"><button class="filter active" data-filter="all">ALL</button>@foreach ($categories as $category)<button class="filter" data-filter="{{ $category->slug }}">{{ strtoupper($category->name) }}</button>@endforeach</div></div>
  <div class="product-grid">
    @foreach ($products as $product)
    @php
      $slug = $product->category?->slug;
      $art = match ($slug) { 'paddle' => ['paddle', 'paddle-shape'], 'kits' => ['shirt', 'shirt-shape'], default => [$loop->odd ? 'red-shoe' : 'cream-shoe', 'sneaker'] };
    @endphp
    <article class="product-card" data-category="{{ $slug }}"><div class="product-art {{ $art[0] }}">@if (! empty($product->images))<img src="{{ asset('storage/'.$product->images[0]) }}" alt="{{ $product->name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover">@else<div class="{{ $art[1] }}"></div>@endif @if ($product->badge)<span class="tag">{{ $product->badge }}</span>@endif<button class="heart" aria-label="Add to favorites">♡</button></div><p class="product-type">{{ strtoupper($product->category?->name ?? 'Gear') }}{{ $product->activity ? ' / '.strtoupper($product->activity) : '' }}</p><h3>{{ $product->name }}{{ $product->color ? ' — '.$product->color : '' }}</h3><div class="product-bottom"><span>₱{{ number_format($product->price) }}</span><button class="add" data-product="{{ $product->name }}">+ ADD</button></div></article>
    @endforeach
  </div>
</section>
<section class="athlete-section" id="athletes">
  <div class="athlete-visual"><div class="athlete-silhouette"></div><span class="vertical-label">LOCAL TALENT. BIG GAME.</span></div>
  <div class="athlete-copy"><p class="eyebrow">BUILT BY THE COMMUNITY</p><h2>OUR CITY.<br>OUR <em>ATHLETES.</em></h2><p>Meet the players putting Dumaguete on the court. We back local talent, celebrate the work, and keep showing up for the game.</p><a class="btn primary" href="{{ route('athletes') }}">MEET OUR ATHLETES ↗</a><div class="athlete-index">01 — COMMUNITY SPOTLIGHT</div></div>
</section>
<section class="section story" id="about"><div class="story-copy"><p class="eyebrow">MORE THAN A STORE</p><h2>ROOTED HERE.<br><em>READY FOR ANYWHERE.</em></h2><p>Kicks Hub Duma is for the early runs, after-work games, weekend rallies and everyday moves. A local sports club for people who love to play.</p><a class="text-link" href="{{ route('about') }}">OUR STORY ↗</a></div><div class="story-art"><div class="story-sun"></div><div class="story-court"></div><span>DUMAGUETE, NEGROS ORIENTAL</span></div></section>
<section class="newsletter" id="newsletter"><div><p class="eyebrow">STAY IN THE ROTATION</p><h2>GOOD NEWS. <em>NO NOISE.</em></h2><p>New drops, local events and community stories — straight to your inbox.</p></div><form id="newsletterForm"><label class="sr-only" for="email">Email address</label><input id="email" type="email" placeholder="Your email address" required><button type="submit">SIGN ME UP ↗</button><small id="newsletterMessage"></small></form></section>
</main>
<footer><a class="brand footer-brand" href="{{ route('home') }}"><div class="logo-mark"><span>KH</span><small>DUMA</small></div><div><b>KICKS HUB DUMA</b><small>YOUR LOCAL SPORTS CLUB</small></div></a><p>GOOD KICKS. REAL GAME. LOCAL SOUL.</p><div class="footer-links"><a href="{{ route('products') }}">Shop</a><a href="{{ route('about') }}">Our story</a><a href="{{ route('athletes') }}">Athletes</a><a href="#newsletter">Contact</a></div><small>© 2026 Kicks Hub Duma. Made for the love of the game.</small></footer>
<div class="toast" id="toast" role="status" aria-live="polite"></div>
<script src="{{ asset('site/home/script.js') }}"></script>
</body>
</html>