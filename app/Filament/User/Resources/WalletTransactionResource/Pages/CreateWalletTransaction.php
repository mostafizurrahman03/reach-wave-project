<?php

namespace App\Filament\User\Resources\WalletTransactionResource\Pages;

use App\Filament\User\Resources\WalletTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWalletTransaction extends CreateRecord
{
    protected static string $resource = WalletTransactionResource::class;
}
