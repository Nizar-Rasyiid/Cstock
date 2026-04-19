<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\CompanyScope;

class Customer extends Model
{

    use HasFactory;

    protected $guarded = [];
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    protected static function newFactory() {
        return \Modules\People\Database\factories\CustomerFactory::new();
    }

}
