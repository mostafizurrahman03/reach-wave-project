<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WalletTopupResource\Pages;
use App\Filament\Admin\Resources\WalletTopupResource\RelationManagers;
use App\Models\WalletTopup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;


class WalletTopupResource extends Resource
{
    protected static ?string $model = WalletTopup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),

                Tables\Columns\TextColumn::make('client.user.name')
                    ->label('Client'),

                Tables\Columns\TextColumn::make('amount')->money('BDT'),

                Tables\Columns\TextColumn::make('payment_method'),

                Tables\Columns\TextColumn::make('trx_id'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ]),

                Tables\Columns\TextColumn::make('approvedBy.name')
                    ->label('Approved By')
                    ->searchable(),    
               
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Approved At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => static::approveTopup($record)),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(fn ($record) => static::rejectTopup($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // ------------------------
    // TOPUP APPROVAL LOGIC
    // ------------------------

    public static function approveTopup($topup)
    {
        DB::transaction(function () use ($topup) {
            // Mark as approved
            $topup->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            // Add money to wallet
            $topup->client->increment('balance', $topup->amount);
        });
    }

    public static function rejectTopup($topup)
    {
        $topup->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWalletTopups::route('/'),
            'create' => Pages\CreateWalletTopup::route('/create'),
            'edit' => Pages\EditWalletTopup::route('/{record}/edit'),
        ];
    }
}
