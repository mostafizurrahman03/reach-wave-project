<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTopup extends Model
{
    protected $fillable = [
        'client_id',
        'amount',
        'payment_method',
        'trx_id',
        'proof_image',
        'status',
        'approved_by',
        'approved_at',
    ];

    public function client()
    {
        return $this->belongsTo(ClientConfiguration::class, 'client_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

}
