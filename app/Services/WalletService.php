<?php

namespace App\Services;

use App\Models\ClientConfiguration;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    /**
     * Credit money to wallet (Topup, Refund, Admin add)
     */
    public static function credit(
        int $clientId,
        float $amount,
        string $source,
        ?string $referenceId = null,
        ?string $description = null
    ): WalletTransaction {

        return DB::transaction(function () use ($clientId, $amount, $source, $referenceId, $description) {

            $client = ClientConfiguration::lockForUpdate()->findOrFail($clientId);

            $before = $client->balance;
            $after = $before + $amount;

            //  Update main balance
            $client->update([
                'balance' => $after
            ]);

            //  Insert ledger
            return WalletTransaction::create([
                'client_id'      => $clientId,
                'type'           => 'credit',
                'amount'         => $amount,
                'balance_before'=> $before,
                'balance_after' => $after,
                'source'         => $source,
                'reference_id'  => $referenceId,
                'description'   => $description,
            ]);
        });
    }

    /**
     * Debit money from wallet (SMS, WhatsApp, API usage)
     */
    public static function debit(
        int $clientId,
        float $amount,
        string $source,
        ?string $referenceId = null,
        ?string $description = null
    ): WalletTransaction {

        return DB::transaction(function () use ($clientId, $amount, $source, $referenceId, $description) {

            $client = ClientConfiguration::lockForUpdate()->findOrFail($clientId);

            if ($client->balance < $amount) {
                throw new Exception("Insufficient wallet balance");
            }

            $before = $client->balance;
            $after = $before - $amount;

            //  Update main balance
            $client->update([
                'balance' => $after
            ]);

            //  Insert ledger
            return WalletTransaction::create([
                'client_id'      => $clientId,
                'type'           => 'debit',
                'amount'         => $amount,
                'balance_before'=> $before,
                'balance_after' => $after,
                'source'         => $source,
                'reference_id'  => $referenceId,
                'description'   => $description,
            ]);
        });
    }
}
