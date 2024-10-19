<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationDetail extends Model
{
    use HasFactory;
    protected $fillable =[
        'quotations',
        'products',
        'product_name',
        'product_code',
        'quantity',
        'price',
        'unit_price',
        'sub_total',
        'product_discount_amount',
        'product_discount_type',
        'product_tax_amount',
    ];

    /**
     * Get the user that owns the QuotationDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
