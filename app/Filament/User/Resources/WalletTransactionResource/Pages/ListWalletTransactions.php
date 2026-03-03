<?php

namespace App\Filament\User\Resources\WalletTransactionResource\Pages;

use App\Filament\User\Resources\WalletTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWalletTransactions extends ListRecords
{
    protected static string $resource = WalletTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
