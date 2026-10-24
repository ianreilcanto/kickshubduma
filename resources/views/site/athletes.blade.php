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
</head>
<body>
  <div class="announcement">
    <strong>DUMAGUETE ROOTS. EVERYDAY MOVEMENT.</strong>
    <span>Free PH shipping on orders ₱5,000+ &nbsp;·&nbsp; Find your next pair →</span>
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
        <p class="eyebrow">THE PEOPLE BEHIND THE MOVEMENT</p>
        <h1>DIFFERENT GAMES.<br>SAME LOCAL SOUL.</h1>
      </div>
      <div class="intro-copy">
        <p>Not just podiums and personal bests. We celebrate the people who lace up, show up, and bring a little more heart to the game.</p>
        <a class="text-link" href="#crew">MEET THE DUMA CREW ↓</a>
      </div>
    </section>

    <div class="disclosure"><span class="info-icon">i</span> CONCEPT ROSTER — Fictional athletes and original portraits, created to tell our story. No real-world endorsements.</div>

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
        <div><p class="eyebrow">OUR ATHLETES / OUR EVERYDAY INSPIRATION</p><h2>GOOD COMPANY. GREAT ENERGY.</h2></div>
        <p class="muted heading-note">Three stories. One shared spirit.</p>
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
      <div class="routine-intro"><p class="eyebrow">BEHIND THE ROUTINE</p><h2>SHOW UP.<br>PUT IN THE WORK.<br>DO IT AGAIN.</h2><p class="body-copy">Every athlete has a rhythm. Small habits, repeated daily, make room for big moments.</p></div>
      <div class="rituals">
        <article><span class="time">05:30</span><div><h3>Start before the noise</h3><p>Quiet streets, a clear head, and a few miles to find your pace.</p></div></article>
        <article><span class="time">16:00</span><div><h3>Put in the reps</h3><p>Work on the basics. Keep it simple. Keep getting better.</p></div></article>
        <article><span class="time">18:30</span><div><h3>Play with your people</h3><p>Meet the crew, share the court, and make the day count.</p></div></article>
      </div>
    </section>

    <section class="gear section-pad" id="products">
      <div class="section-heading">
        <div><p class="eyebrow">PICKS FROM THE CREW</p><h2>GEAR THAT GETS OUT THERE.</h2></div>
        <a class="button button-outline" href="{{ route('products') }}">SHOP ALL GEAR <span>↗</span></a>
      </div>
      <div class="product-grid">
        @foreach ($products as $product)
        <article class="product-card">
          <div class="product-art {{ ['shoe-art', 'runner-art', 'everyday-art'][$loop->index % 3] }}">@if ($product->badge)<span class="product-tag">{{ $product->badge }}</span>@endif<button class="heart" aria-label="Save {{ $product->name }}">♡</button>@if (! empty($product->images))<img src="{{ asset('storage/'.$product->images[0]) }}" alt="{{ $product->name }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0">@else<div class="shoe-shape">{{ strtoupper(Str::of($product->name)->explode(' ')->first()) }}</div>@endif</div>
          <div class="product-meta"><div><h3>{{ $product->name }}</h3><p class="muted">{{ $product->description }}</p></div><strong>₱{{ number_format($product->price) }}</strong></div>
          <div class="product-bottom"><div class="swatches"><i></i><i></i><i></i></div><button class="quick-add" data-product="{{ $product->name }}">QUICK ADD ＋</button></div>
        </article>
        @endforeach
      </div>
    </section>

    <section class="categories section-pad" id="categories">
      <div class="section-heading"><div><p class="eyebrow">FIND YOUR NEXT PAIR</p><h2>MADE FOR YOUR KIND OF MOVE.</h2></div><p class="muted heading-note">Find your game. Find your fit.</p></div>
      <div class="category-grid">
        <a href="{{ route('products') }}" class="category category-large"><span class="category-count">01 / COURT COLLECTION</span><strong>COURT<br>READY.</strong><span class="category-arrow">↗</span></a>
        <a href="{{ route('products') }}" class="category category-run"><span class="category-count">02 / RUN COLLECTION</span><strong>FIND<br>YOUR PACE.</strong><span class="category-arrow">↗</span></a>
        <a href="{{ route('products') }}" class="category category-life"><span class="category-count">03 / EVERYDAY</span><strong>MOVE<br>YOUR WAY.</strong><span class="category-arrow">↗</span></a>
      </div>
    </section>

    <section class="spotlight">
      <div class="spotlight-art"><span class="portrait-label">LOCAL STORIES / DUMA</span><div class="portrait-silhouette"><span>KH</span></div></div>
      <div class="spotlight-copy"><p class="eyebrow">MORE THAN A PAIR OF SHOES</p><h2>BUILT FOR THE<br>ONES WHO SHOW UP.</h2><p class="body-copy">We’re here for the early starts, the last-minute games, and the people who make every session worth it.</p><div class="identity"><strong>KICKS HUB DUMA</strong><small>LOCAL MOVEMENT. SHARED ENERGY.</small></div><a class="button button-red" href="{{ route('about') }}">OUR STORY <span>↗</span></a><small class="concept-note">Concept brand page — sample content for layout demonstration.</small></div>
    </section>

    <section class="training-kit">
      <div class="training-copy"><p class="eyebrow">THE EVERYDAY KIT</p><h2>YOUR NEXT<br>SESSION STARTS HERE.</h2><p class="body-copy">Good gear won’t do the work for you. But it can help you show up ready.</p><a class="button button-outline" href="#products">EXPLORE THE KIT <span>↗</span></a></div>
      <div class="training-art" role="img" aria-label="Abstract sports gear illustration"><span>TRAIN / PLAY / REPEAT</span></div>
    </section>

    <section class="local-story section-pad" id="about">
      <div class="heritage-mark"><div class="brand-mark large"><span>KH</span><small>DUMA</small></div><p>ROOTED HERE. READY TO MOVE.</p></div>
      <div class="local-copy"><p class="eyebrow">OUR LOCAL STORY</p><h2>A LITTLE LOCAL PRIDE.<br>A LOT OF LOVE FOR THE GAME.</h2><p class="body-copy">Kicks Hub Duma is inspired by the energy of Dumaguete — a place where community comes together through sport, movement, and everyday moments.</p><a class="button button-red" href="#newsletter">BE PART OF THE CLUB <span>↗</span></a></div>
    </section>

    <section class="fit-guide section-pad"><div class="fit-icon">↔</div><div><h3>Not sure about your fit?</h3><p>Find your size and get ready to move comfortably.</p></div><a class="button button-outline" href="#products">FIND YOUR FIT <span>↗</span></a></section>

    <section class="journal section-pad">
      <div class="section-heading"><div><p class="eyebrow">FIELD NOTES / FROM THE CLUB</p><h2>GOOD GAMES. GOOD STORIES.</h2></div><a class="text-link" href="#journal">READ ALL STORIES ↗</a></div>
      <div class="journal-grid" id="journal">
        <article><div class="journal-art journal-one"></div><p class="eyebrow">COMMUNITY / 4 MIN READ</p><h3>Why showing up is the real win <span>↗</span></h3><p class="muted">The small rituals that make movement stick.</p></article>
        <article><div class="journal-art journal-two"></div><p class="eyebrow">TRAINING / 5 MIN READ</p><h3>Build a routine you can keep <span>↗</span></h3><p class="muted">Progress starts with the basics.</p></article>
        <article><div class="journal-art journal-three"></div><p class="eyebrow">LOCAL LIFE / 3 MIN READ</p><h3>Meet you at the court <span>↗</span></h3><p class="muted">It’s always better when we play together.</p></article>
      </div>
    </section>

    <section class="newsletter section-pad" id="newsletter">
      <div><p class="eyebrow">JOIN THE CLUB</p><h2>GOOD THINGS MOVE TOGETHER.</h2><p>Get new drops, local stories, and club updates in your inbox.</p></div>
      <form id="newsletter-form"><div class="email-row"><label class="sr-only" for="email">Your email address</label><input id="email" type="email" placeholder="Your email address" required><button type="submit">SIGN ME UP ↗</button></div><small id="form-message">By signing up, you agree to receive occasional updates from Kicks Hub Duma.</small></form>
    </section>
  </main>

  <footer class="site-footer section-pad">
    <div class="footer-main">
      <div class="footer-brand"><a class="brand" href="{{ route('home') }}"><div class="brand-mark"><span>KH</span><small>DUMA</small></div></a><p>Local movement. Shared energy.<br>Made for the way we move.</p><div class="socials"><a href="#instagram">Instagram</a><a href="#facebook">Facebook</a><span>@@kickshubduma</span></div></div>
      <div class="footer-links"><h4>SHOP</h4><a href="{{ route('products') }}">All products</a><a href="{{ route('products') }}">Court shoes</a><a href="{{ route('products') }}">Running</a><a href="{{ route('products') }}">Everyday</a></div>
      <div class="footer-links"><h4>THE CLUB</h4><a href="{{ route('about') }}">Our story</a><a href="{{ route('athletes') }}">Our athletes</a><a href="#journal">Field notes</a><a href="#newsletter">Join the club</a></div>
      <div class="footer-links"><h4>NEED HELP?</h4><a href="#fit">Size guide</a><a href="#shipping">Shipping</a><a href="#returns">Returns</a><a href="#contact">Contact us</a></div>
    </div>
    <div class="footer-legal"><span>© 2026 Kicks Hub Duma. Concept storefront.</span><span>Privacy &nbsp; · &nbsp; Terms &nbsp; · &nbsp; Shipping policy</span><span>Made for movement in Dumaguete, PH.</span></div>
  </footer>
  <div class="toast" id="toast" role="status" aria-live="polite"></div>
  <script src="{{ asset('site/athletes/script.js') }}"></script>
</body>
</html>
