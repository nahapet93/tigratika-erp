<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
	public function products(): HasMany
    {
		return $this->hasMany(Product::class);
	}
}
