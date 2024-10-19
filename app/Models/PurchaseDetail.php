<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable =[
        'quantity',
        'unitcost',
        'total',
    ];

    /**
     * Get the user that owns the PurchaseDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(purchase::class);
    }
   
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
