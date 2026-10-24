<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kicks Hub Duma — your local sports club. Meet the crew, discover your next pair, and move with the community.">
  <title>Kicks Hub Duma — Our Athletes</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('site/athletes/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('site/cms.css') }}">
</head>
<body>
  <div class="announcement">
    <strong>{{ $c['announcement_title'] }}</strong>
    <span>{{ $c['announcement_text'] }}</span>
  </div>

  <header class="site-header">
    <a class="brand" href="{{ route('home') }}" aria-label="Kicks Hub Duma home">
      <div class="brand-mark" aria-hidden="true"><span>KH</span><small>DUMA</small></div>
      <div class="brand-copy"><strong>KICKS HUB DUMA</strong><small>YOUR LOCAL SPORTS CLUB</small></div>
    </a>
    <button class="menu-toggle" aria-expanded="false" aria-label="Open navigation">☰</button>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="{{ route('home') }}">Home</a><a href="{{ route('products') }}">Products</a><a href="{{ route('about') }}">About</a><a class="active" href="{{ route('athletes') }}">Our Athletes</a>
    </nav>
    <div class="shop-tools">
      <button aria-label="Search" class="icon-button" id="search-toggle">⌕</button>
      <button aria-label="Account" class="icon-button">♙</button>
      <button aria-label="Shopping bag" class="bag-button">▱ <span>Bag (<b id="bag-count">0</b>)</span></button>
    </div>
  </header>

  <main>
    <section class="intro section-pad" id="athletes">
      <div class="intro-title">
        <p class="breadcrumb">Home / Our Athletes</p>
        <p class="eyebrow">{{ $c['intro_eyebrow'] }}</p>
        <h1>{!! nl2br(e($c['intro_title'])) !!}</h1>
      </div>
      <div class="intro-copy">
        <p>{{ $c['intro_text'] }}</p>
        <a class="text-link" href="#crew">{{ $c['intro_link'] }} ↓</a>
      </div>
    </section>

    @if ($c['show_disclosure'])
    <div class="disclosure"><span class="info-icon">i</span> {{ $c['disclosure'] }}</div>
    @endif

    @if ($featured)
    <section class="featured">
      <div class="portrait portrait-nico" role="img" aria-label="{{ $featured->name }} portrait"@if ($featured->photo) style="background-image:url('{{ asset('storage/'.$featured->photo) }}');background-size:cover;background-position:center"@endif>
        <span class="portrait-label">KH / ATHLETE SERIES {{ str_pad($featured->id, 2, '0', STR_PAD_LEFT) }}</span>
        <div class="portrait-silhouette"><span>{{ $featured->initials }}</span></div>
      </div>
      <div class="featured-copy">
        <p class="eyebrow">IN FOCUS / {{ str_pad($featured->id, 2, '0', STR_PAD_LEFT) }} / {{ strtoupper($featured->sport) }}</p>
        <h2>{{ strtoupper($featured->name) }}.</h2>
        @if ($featured->quote)<blockquote>“{{ $featured->quote }}”</blockquote>@endif
        @if ($featured->bio)<p class="body-copy">{{ $featured->bio }}</p>@endif
        <div class="facts">
          <div><small>HOME COURT</small><strong>{{ $featured->home_court ?? 'Dumaguete' }}</strong></div>
          @if ($featured->goToProduct)<div><small>GO-TO PAIR</small><strong>{{ $featured->goToProduct->name }}</strong></div>@endif
          @if ($featured->mindset)<div><small>MINDSET</small><strong>{{ $featured->mindset }}</strong></div>@endif
        </div>
        <a class="button button-red" href="{{ route('products') }}">SHOP {{ strtoupper(Str::of($featured->name)->explode(' ')->first()) }}’S COURT PICK <span>↗</span></a>
      </div>
    </section>
    @endif

    <section class="crew section-pad" id="crew">
      <div class="section-heading">
        <div><p class="eyebrow">{{ $c['crew_eyebrow'] }}</p><h2>{{ $c['crew_title'] }}</h2></div>
        <p class="muted heading-note">{{ $c['crew_note'] }}</p>
      </div>
      <div class="filters" role="group" aria-label="Filter athletes">
        <button class="filter active" data-filter="all">All athletes</button>
        @foreach ($sports as $sport)
        <button class="filter" data-filter="{{ $sport }}">{{ $sport }}</button>
        @endforeach
      </div>
      <div class="athlete-grid">
        @foreach ($athletes as $athlete)
        <article class="athlete-card" data-sport="{{ $athlete->sport }}">
          <div class="athlete-photo photo-{{ ['one', 'two', 'three'][$loop->index % 3] }}"@if ($athlete->photo) style="background-image:url('{{ asset('storage/'.$athlete->photo) }}');background-size:cover;background-position:center"@endif><span class="sport-badge">{{ strtoupper($athlete->sport) }}</span><span class="photo-initials">{{ $athlete->initials }}</span></div>
          <div class="athlete-name"><h3>{{ $athlete->name }}</h3><span>↗</span></div>
          <p class="muted">{{ strtoupper($athlete->tagline) }}</p>@if ($athlete->quote)<p class="quote">“{{ $athlete->quote }}”</p>@endif
        </article>
        @endforeach
      </div>
    </section>

    <section class="routine section-pad">
      <div class="routine-intro"><p class="eyebrow">{{ $c['routine_eyebrow'] }}</p><h2>{!! nl2br(e($c['routine_title'])) !!}</h2><p class="body-copy">{{ $c['routine_text'] }}</p></div>
      <div class="rituals">
        @foreach ($c['rituals'] as $ritual)
        <article><span class="time">{{ $ritual['time'] }}</span><div><h3>{{ $ritual['title'] }}</h3><p>{{ $ritual['text'] }}</p></div></article>
        @endforeach
      </div>
    </section>

    <section class="gear section-pad" id="products">
      <div class="section-heading">
        <div><p class="eyebrow">{{ $c['gear_eyebrow'] }}</p><h2>{{ $c['gear_title'] }}</h2></div>
        <a class="button button-outline" href="{{ route('products') }}">{{ $c['gear_button'] }} <span>↗</span></a>
      </div>
      <div class="product-grid">
        @foreach ($products as $product)
        <article class="product-card">
          <div class="product-art {{ ['shoe-art', 'runner-art', 'everyday-art'][$loop->index % 3] }}">@if ($product->badge)<span class="product-tag">{{ $product->badge }}</span>@endif<button class="heart" aria-label="Save {{ $product->name }}">♡</button><img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0"></div>
          <div class="product-meta"><div><h3>{{ $product->name }}</h3><p class="muted">{{ $product->description }}</p></div><strong>₱{{ number_format($product->price) }}</strong></div>
          <div class="product-bottom"><div class="swatches"><i></i><i></i><i></i></div><button class="quick-add" data-product="{{ $product->name }}">QUICK ADD ＋</button></div>
        </article>
        @endforeach
      </div>
    </section>

    <section class="categories section-pad" id="categories">
      <div class="section-heading"><div><p class="eyebrow">{{ $c['categories_eyebrow'] }}</p><h2>{{ $c['categories_title'] }}</h2></div><p class="muted heading-note">{{ $c['categories_note'] }}</p></div>
      <div class="category-grid">
        @foreach ($c['category_cards'] as $card)
        <a href="{{ route('products') }}" class="category {{ ['category-large', 'category-run', 'category-life'][$loop->index % 3] }}"><span class="category-count">{{ $card['tag'] }}</span><strong>{!! nl2br(e($card['title'])) !!}</strong><span class="category-arrow">↗</span></a>
        @endforeach
      </div>
    </section>

    <section class="spotlight">
      <div @class(['spotlight-art', 'has-cms-image' => $c['spotlight_image']])>@if ($c['spotlight_image'])<img class="cms-img" src="{{ \App\Support\SiteContent::url($c['spotlight_image']) }}" alt="">@endif<span class="portrait-label">LOCAL STORIES / DUMA</span><div class="portrait-silhouette cms-hide"><span>KH</span></div></div>
      <div class="spotlight-copy"><p class="eyebrow">{{ $c['spotlight_eyebrow'] }}</p><h2>{!! nl2br(e($c['spotlight_title'])) !!}</h2><p class="body-copy">{{ $c['spotlight_text'] }}</p><div class="identity"><strong>{{ $c['spotlight_identity'] }}</strong><small>{{ $c['spotlight_identity_sub'] }}</small></div><a class="button button-red" href="{{ route('about') }}">{{ $c['spotlight_button'] }} <span>↗</span></a><small class="concept-note">Concept brand page — sample content for layout demonstration.</small></div>
    </section>

    <section class="training-kit">
      <div class="training-copy"><p class="eyebrow">{{ $c['kit_eyebrow'] }}</p><h2>{!! nl2br(e($c['kit_title'])) !!}</h2><p class="body-copy">{{ $c['kit_text'] }}</p><a class="button button-outline" href="#products">{{ $c['kit_button'] }} <span>↗</span></a></div>
      <div @class(['training-art', 'has-cms-image' => $c['kit_image']]) role="img" aria-label="Abstract sports gear illustration">@if ($c['kit_image'])<img class="cms-img" src="{{ \App\Support\SiteContent::url($c['kit_image']) }}" alt="">@endif<span>{{ $c['kit_art'] }}</span></div>
    </section>

    <section class="local-story section-pad" id="about">
      <div class="heritage-mark"><div class="brand-mark large"><span>KH</span><small>DUMA</small></div><p>{{ $c['local_mark'] }}</p></div>
      <div class="local-copy"><p class="eyebrow">{{ $c['local_eyebrow'] }}</p><h2>{!! nl2br(e($c['local_title'])) !!}</h2><p class="body-copy">{{ $c['local_text'] }}</p><a class="button button-red" href="#newsletter">{{ $c['local_button'] }} <span>↗</span></a></div>
    </section>

    <section class="fit-guide section-pad"><div class="fit-icon">↔</div><div><h3>{{ $c['fit_title'] }}</h3><p>{{ $c['fit_text'] }}</p></div><a class="button button-outline" href="#products">{{ $c['fit_button'] }} <span>↗</span></a></section>

    <section class="journal section-pad">
      <div class="section-heading"><div><p class="eyebrow">{{ $c['journal_eyebrow'] }}</p><h2>{{ $c['journal_title'] }}</h2></div><a class="text-link" href="#journal">{{ $c['journal_link'] }} ↗</a></div>
      <div class="journal-grid" id="journal">
        @foreach ($c['journal'] as $story)
        <article><div @class(['journal-art', ['journal-one', 'journal-two', 'journal-three'][$loop->index % 3] => empty($story['image']), 'has-cms-image' => ! empty($story['image'])])>@if (! empty($story['image']))<img class="cms-img" src="{{ \App\Support\SiteContent::url($story['image']) }}" alt="">@endif</div><p class="eyebrow">{{ $story['tag'] }}</p><h3>{{ $story['title'] }} <span>↗</span></h3><p class="muted">{{ $story['text'] }}</p></article>
        @endforeach
      </div>
    </section>

    <section class="newsletter section-pad" id="newsletter">
      <div><p class="eyebrow">{{ $c['newsletter_eyebrow'] }}</p><h2>{{ $c['newsletter_title'] }}</h2><p>{{ $c['newsletter_text'] }}</p></div>
      <form id="newsletter-form"><div class="email-row"><label class="sr-only" for="email">Your email address</label><input id="email" type="email" placeholder="Your email address" required><button type="submit">SIGN ME UP ↗</button></div><small id="form-message">{{ $c['newsletter_fine_print'] }}</small></form>
    </section>
  </main>

  <footer class="site-footer section-pad">
    <div class="footer-main">
      <div class="footer-brand"><a class="brand" href="{{ route('home') }}"><div class="brand-mark"><span>KH</span><small>DUMA</small></div></a><p>Local movement. Shared energy.<br>Made for the way we move.</p><div class="socials"><a href="#instagram">Instagram</a><a href="#facebook">Facebook</a><span>@@kickshubduma</span></div></div>
      <div class="footer-links"><h4>SHOP</h4><a href="{{ route('products') }}">All products</a><a href="{{ route('products') }}">Court shoes</a><a href="{{ route('products') }}">Running</a><a href="{{ route('products') }}">Everyday</a></div>
      <div class="footer-links"><h4>THE CLUB</h4><a href="{{ route('about') }}">Our story</a><a href="{{ route('athletes') }}">Our athletes</a><a href="#journal">Field notes</a><a href="#newsletter">Join the club</a></div>
      <div class="footer-links"><h4>NEED HELP?</h4><a href="#fit">Size guide</a><a href="#shipping">Shipping</a><a href="#returns">Returns</a><a href="#contact">Contact us</a></div>
    </div>
    <div class="footer-legal"><span>{{ $c['footer_copyright'] }}</span><span>Privacy &nbsp; · &nbsp; Terms &nbsp; · &nbsp; Shipping policy</span><span>Made for movement in Dumaguete, PH.</span></div>
  </footer>
  <div class="toast" id="toast" role="status" aria-live="polite"></div>
  <script src="{{ asset('site/athletes/script.js') }}"></script>
</body>
</html>
