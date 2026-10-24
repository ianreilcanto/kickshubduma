<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\SiteContent;

#[Fillable(['brand_id', 'category_id', 'name', 'sku', 'description', 'badge', 'activity', 'color', 'sizes', 'images', 'price', 'stock', 'is_active'])]
class Product extends Model
{
    use SoftDeletes;

    /** First uploaded image, else the default product image from Content → Products Page, else the built-in placeholder. */
    protected function imageUrl(): Attribute
    {
        return Attribute::get(fn () => SiteContent::url($this->images[0] ?? null)
            ?? SiteContent::url(SiteContent::get('products')['default_product_image'])
            ?? asset('site/default-product.svg'));
    }

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'sizes' => 'array',
            'price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
