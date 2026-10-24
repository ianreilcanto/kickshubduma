<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kicks Hub Duma — Good Kicks. Real Game. Local Soul.</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('site/home/styles.css') }}">
<link rel="stylesheet" href="{{ asset('site/cms.css') }}">
</head>
<body>
<div class="announcement"><strong>{{ $c['announcement_title'] }}</strong><span>{{ $c['announcement_text'] }}</span></div>
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
    <p class="eyebrow">{{ $c['hero_eyebrow'] }}</p>
    <h1>{!! nl2br(e($c['hero_title'])) !!}<br><em>{{ $c['hero_highlight'] }}</em></h1>
    <div class="intro"><p>{{ $c['hero_text'] }}</p>
      <div class="actions"><a class="btn primary" href="{{ route('products') }}">{{ $c['hero_primary_button'] }} <span>↗</span></a><a class="btn outline" href="{{ route('products') }}">{{ $c['hero_secondary_button'] }}</a></div>
    </div>
    <p class="hero-note">{{ $c['hero_note'] }}</p>
  </div>
  <div class="hero-visual">
    <div @class(['photo-placeholder', 'hero-photo', 'has-cms-image' => $c['hero_image']]) role="img" aria-label="Editorial sneaker photograph">@if ($c['hero_image'])<img class="cms-img" src="{{ \App\Support\SiteContent::url($c['hero_image']) }}" alt="">@endif<div class="shoe-shape cms-hide"></div><div class="photo-caption">{{ $c['hero_caption'] }}</div></div>
    <div class="seal"><small>{{ $c['hero_seal_top'] }}</small><strong>{{ $c['hero_seal_main'] }}</strong><small>{{ $c['hero_seal_bottom'] }}</small></div>
    <div class="feature-caption"><div><b>{{ $c['feature_title'] }}</b><span>{{ $c['feature_text'] }}</span></div><a href="{{ route('products') }}" aria-label="View featured shoe">↗</a></div>
  </div>
</section>
<div class="ribbon">@foreach ($c['ribbon'] as $item)<span>{{ $item['text'] }}　 +</span>@endforeach</div>
<section class="assurances">
  @foreach ($c['assurances'] as $item)
  <div><span class="assurance-icon">{{ $item['icon'] }}</span><p><b>{{ $item['title'] }}</b><small>{{ $item['text'] }}</small></p></div>
  @endforeach
</section>
<section class="section categories" id="products">
  <div class="section-heading"><div><p class="eyebrow">{{ $c['categories_eyebrow'] }}</p><h2>{{ $c['categories_title'] }} <em>{{ $c['categories_highlight'] }}</em></h2></div><a class="text-link" href="{{ route('products') }}">{{ $c['categories_link'] }} ↗</a></div>
  <div class="category-grid">
    @foreach ($c['category_cards'] as $card)
    <a class="category-card {{ ['cat-shoes', 'cat-court', 'cat-apparel'][$loop->index % 3] }}" href="{{ route('products') }}"><div @class(['category-art', ['sneaker-art', 'paddle-art', 'apparel-art'][$loop->index % 3] => empty($card['image']), 'has-cms-image' => ! empty($card['image'])])>@if (! empty($card['image']))<img class="cms-img" src="{{ \App\Support\SiteContent::url($card['image']) }}" alt="">@endif</div><span>{{ $card['tag'] }}</span><h3>{!! nl2br(e($card['title'])) !!}</h3><b>{{ $card['cta'] }} ↗</b></a>
    @endforeach
  </div>
</section>
<section class="section product-section" id="shop-grid">
  <div class="section-heading"><div><p class="eyebrow">{{ $c['products_eyebrow'] }}</p><h2>{{ $c['products_title'] }} <em>{{ $c['products_highlight'] }}</em></h2></div><div class="filters"><button class="filter active" data-filter="all">ALL</button>@foreach ($categories as $category)<button class="filter" data-filter="{{ $category->slug }}">{{ strtoupper($category->name) }}</button>@endforeach</div></div>
  <div class="product-grid">
    @foreach ($products as $product)
    @php
      $slug = $product->category?->slug;
      $art = match ($slug) { 'paddle' => ['paddle', 'paddle-shape'], 'kits' => ['shirt', 'shirt-shape'], default => [$loop->odd ? 'red-shoe' : 'cream-shoe', 'sneaker'] };
    @endphp
    <article class="product-card" data-category="{{ $slug }}"><div class="product-art {{ $art[0] }}"><img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover"> @if ($product->badge)<span class="tag">{{ $product->badge }}</span>@endif<button class="heart" aria-label="Add to favorites">♡</button></div><p class="product-type">{{ strtoupper($product->category?->name ?? 'Gear') }}{{ $product->activity ? ' / '.strtoupper($product->activity) : '' }}</p><h3>{{ $product->name }}{{ $product->color ? ' — '.$product->color : '' }}</h3><div class="product-bottom"><span>₱{{ number_format($product->price) }}</span><button class="add" data-product="{{ $product->name }}">+ ADD</button></div></article>
    @endforeach
  </div>
</section>
<section class="athlete-section" id="athletes">
  <div @class(['athlete-visual', 'has-cms-image' => $c['athletes_image']])>@if ($c['athletes_image'])<img class="cms-img" src="{{ \App\Support\SiteContent::url($c['athletes_image']) }}" alt="">@endif<div class="athlete-silhouette cms-hide"></div><span class="vertical-label">{{ $c['athletes_label'] }}</span></div>
  <div class="athlete-copy"><p class="eyebrow">{{ $c['athletes_eyebrow'] }}</p><h2>{!! nl2br(e($c['athletes_title'])) !!} <em>{{ $c['athletes_highlight'] }}</em></h2><p>{{ $c['athletes_text'] }}</p><a class="btn primary" href="{{ route('athletes') }}">{{ $c['athletes_button'] }} ↗</a><div class="athlete-index">{{ $c['athletes_index'] }}</div></div>
</section>
<section class="section story" id="about"><div class="story-copy"><p class="eyebrow">{{ $c['story_eyebrow'] }}</p><h2>{{ $c['story_title'] }}<br><em>{{ $c['story_highlight'] }}</em></h2><p>{{ $c['story_text'] }}</p><a class="text-link" href="{{ route('about') }}">{{ $c['story_link'] }} ↗</a></div><div @class(['story-art', 'has-cms-image' => $c['story_image']])>@if ($c['story_image'])<img class="cms-img" src="{{ \App\Support\SiteContent::url($c['story_image']) }}" alt="">@endif<div class="story-sun cms-hide"></div><div class="story-court cms-hide"></div><span>{{ $c['story_location'] }}</span></div></section>
<section class="newsletter" id="newsletter"><div><p class="eyebrow">{{ $c['newsletter_eyebrow'] }}</p><h2>{{ $c['newsletter_title'] }} <em>{{ $c['newsletter_highlight'] }}</em></h2><p>{{ $c['newsletter_text'] }}</p></div><form id="newsletterForm"><label class="sr-only" for="email">Email address</label><input id="email" type="email" placeholder="Your email address" required><button type="submit">SIGN ME UP ↗</button><small id="newsletterMessage"></small></form></section>
</main>
<footer><a class="brand footer-brand" href="{{ route('home') }}"><div class="logo-mark"><span>KH</span><small>DUMA</small></div><div><b>KICKS HUB DUMA</b><small>YOUR LOCAL SPORTS CLUB</small></div></a><p>{{ $c['footer_tagline'] }}</p><div class="footer-links"><a href="{{ route('products') }}">Shop</a><a href="{{ route('about') }}">Our story</a><a href="{{ route('athletes') }}">Athletes</a><a href="#newsletter">Contact</a></div><small>{{ $c['footer_copyright'] }}</small></footer>
<div class="toast" id="toast" role="status" aria-live="polite"></div>
<script src="{{ asset('site/home/script.js') }}"></script>
</body>
</html>