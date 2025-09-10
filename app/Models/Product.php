<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'colors',
        'images',
        'description',
    ];

    // علاقة مع المخزون
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // علاقة مع العروض
    public function offers()
    {
        return $this->belongsToMany(Offers::class, 'product_offers');
    }

    // علاقة مع تفاصيل المعاملات
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}

