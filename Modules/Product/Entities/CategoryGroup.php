<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\CompanyScope;

class CategoryGroup extends Model
{
    use HasFactory;

    protected $table = 'group_categories';
    protected $guarded = [];
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function categories() {
        return $this->hasMany(Category::class, 'group_category_id', 'id');
    }
}
