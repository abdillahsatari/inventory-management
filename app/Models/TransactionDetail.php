<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'inventory_name',
        'inventory_price',
        'quantity',
        'inventory_discount',
        'inventory_total_price',
        'inventory_point'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function inventory()
    {
        return $this->BelongsTo(Inventory::class, 'inventory_id');
    }
}
