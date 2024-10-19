<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable =[
        'customers',
        'order_date',
        'order_status',
        'total_products',
        'sub_total',
        'vat',
        'total',
        'invoice_no',
        'payment_type',
        'pay',
        'due',
    ];
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'order_date'    => 'date',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'order_status'  => OrderStatus::class
    ];

    /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
