<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'colors',
        'images',
        'description',
        'price_before',
        'price_after',
    ];

    // ✅ لو عايزة تتعامل معاهم كأرقام (float) مش نصوص
    protected $casts = [
        'colors' => 'array',
        'images' => 'array',
        'price_before' => 'float',
        'price_after' => 'float',
    ];

    // علاقة مع المخزون
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // // علاقة مع العروض
    // public function offers()
    // {
    //     return $this->belongsToMany(Offers::class, 'product_offers');
    // }

    // علاقة مع تفاصيل المعاملات
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
    // App\Models\Product.php
// App\Models\Product.php
public function offers()
{
    return $this->belongsToMany(Offer::class, 'offer_products', 'product_id', 'offer_id');
}

public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function branches()
{
    return $this->hasManyThrough(
        Branch::class,      // الهدف
        Warehouse::class,   // الجدول الوسيط (المستودعات)
        'branch_id',        // المفتاح الأجنبي في warehouses → branch_id
        'id',               // المفتاح الأساسي في branches
        'id',               // المفتاح الأساسي في products
        'warehouse_id'      // المفتاح الأجنبي في warehouses → product_id
    );
}




 }
