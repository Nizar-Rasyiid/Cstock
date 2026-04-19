<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\CompanyScope;

class GroupCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
