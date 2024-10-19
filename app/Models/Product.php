<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'slug',
        'code',
        'quantity',
        'buying_price',
        'selling_price',
        'quantity_alert',
        'tax',
        'tax_type',
        'notes',
        'product_image',
    ];

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, );
    }


    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function purchase_details(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
