<?php

namespace Modules\Expense\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\CompanyScope;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'category_id', 'id');
    }
}
