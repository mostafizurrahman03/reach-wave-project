<?php

namespace App\Filament\Admin\Resources\WalletTopupResource\Pages;

use App\Filament\Admin\Resources\WalletTopupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWalletTopup extends EditRecord
{
    protected static string $resource = WalletTopupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
