<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Category;
use App\Models\Product;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'categories' => Category::query()->where('is_visible', true)->orderBy('id')->get(),
            'products' => Product::with('category')->where('is_active', true)->latest('id')->take(4)->get(),
        ]);
    }

    public function about()
    {
        return view('site.about');
    }

    public function products()
    {
        $products = Product::with('category')->where('is_active', true)->orderBy('id')->get();

        return view('site.products', [
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

        return view('site.athletes', [
            'athletes' => $athletes,
            'featured' => $athletes->firstWhere('is_featured', true) ?? $athletes->first(),
            'sports' => $athletes->pluck('sport')->unique()->values(),
            'products' => Product::where('is_active', true)->latest('id')->take(3)->get(),
        ]);
    }
}
