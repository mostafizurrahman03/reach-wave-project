<?php

namespace App\Filament\User\Resources\WalletTransactionResource\Pages;

use App\Filament\User\Resources\WalletTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWalletTransaction extends EditRecord
{
    protected static string $resource = WalletTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['vendor_configuration_id'] = auth()->user()->vendor_configuration_id;
        return $data;
    }

}
