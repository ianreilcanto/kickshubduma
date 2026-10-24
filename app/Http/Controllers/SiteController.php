<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Category;
use App\Models\Product;
use App\Support\SiteContent;

class SiteController extends Controller
{
    public function home()
    {
        $content = SiteContent::get('home');

        return view('site.home', [
            'c' => $content,
            'categories' => Category::query()->where('is_visible', true)->orderBy('id')->get(),
            'products' => Product::with('category')->where('is_active', true)->latest('id')->take(max(1, (int) $content['products_limit']))->get(),
        ]);
    }

    public function about()
    {
        return view('site.about', ['c' => SiteContent::get('about')]);
    }

    public function products()
    {
        $products = Product::with('category')->where('is_active', true)->orderBy('id')->get();

        return view('site.products', [
            'c' => SiteContent::get('products'),
            'products' => $products,
            'categories' => Category::query()->where('is_visible', true)->orderBy('id')->get()
                ->each(fn ($c) => $c->shown_count = $products->where('category_id', $c->id)->count()),
            'activities' => $products->pluck('activity')->filter()->unique()->sort()->values()
                ->mapWithKeys(fn ($a) => [$a => $products->where('activity', $a)->count()]),
            'maxPrice' => max(8000, (int) (ceil((float) $products->max('price') / 250) * 250)),
        ]);
    }

    public function athletes()
    {
        $athletes = Athlete::active()->with('goToProduct')->get();

        $content = SiteContent::get('athletes');

        return view('site.athletes', [
            'c' => $content,
            'athletes' => $athletes,
            'featured' => $athletes->firstWhere('is_featured', true) ?? $athletes->first(),
            'sports' => $athletes->pluck('sport')->unique()->values(),
            'products' => Product::where('is_active', true)->latest('id')->take(max(1, (int) $content['gear_limit']))->get(),
        ]);
    }
}
