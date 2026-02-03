<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'source',
        'reference_id',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    /**
     * Each transaction belongs to a client wallet
     */
    public function client()
    {
        return $this->belongsTo(ClientConfiguration::class, 'client_id');
    }

    /**
     * Credit transactions
     */
    public function scopeCredit($query)
    {
        return $query->where('type', 'credit');
    }

    /**
     * Debit transactions
     */
    public function scopeDebit($query)
    {
        return $query->where('type', 'debit');
    }
}

