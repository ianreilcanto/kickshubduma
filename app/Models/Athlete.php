<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug', 'sport', 'tagline', 'quote', 'bio', 'photo', 'home_court', 'go_to_product_id', 'mindset', 'is_featured', 'is_active', 'sort_order'])]
class Athlete extends Model
{
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function goToProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'go_to_product_id');
    }

    public function getInitialsAttribute(): string
    {
        return Str::of($this->name)->explode(' ')->map(fn ($w) => Str::upper(Str::substr($w, 0, 1)))->take(2)->implode('');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }
}
