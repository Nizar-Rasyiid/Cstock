<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\CompanyScope;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function categoryGroup() {
        return $this->belongsTo(CategoryGroup::class, 'group_category_id', 'id');
    }

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
