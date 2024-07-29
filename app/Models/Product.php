<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->children->each->delete();
        });
    }
    public function parent(): BelongsTo
    {
		return $this->belongsTo(Product::class, 'parent_id');
	}

	public function source(): BelongsTo
	{
		return $this->belongsTo(Source::class);
	}

	public function children(): HasMany
	{
		return $this->hasMany(Product::class, 'parent_id');
	}
}
