<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\WalletTransactionResource\Pages;
use App\Models\WalletTransaction;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class WalletTransactionResource extends Resource
{
    protected static ?string $model = WalletTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'My Wallet';
    protected static ?string $navigationGroup = 'Billing';
    protected static ?int $navigationSort = 5;

    /**
     * Only show logged-in user's wallet transactions
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('client_id', auth()->user()->client_id);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Read-only Ledger – no form
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),

                BadgeColumn::make('type')
                    ->colors([
                        'success' => 'credit',
                        'danger' => 'debit',
                    ])
                    ->sortable(),

                TextColumn::make('amount')
                    ->money('BDT', true)
                    ->sortable(),

                TextColumn::make('balance_after')
                    ->label('Balance')
                    ->money('BDT', true)
                    ->sortable(),

                BadgeColumn::make('source')
                    ->colors([
                        'primary' => 'sms',
                        'warning' => 'whatsapp',
                        'success' => 'payment',
                        'danger' => 'refund',
                        'secondary' => 'admin',
                    ]),

                TextColumn::make('reference_id')
                    ->label('Ref')
                    ->toggleable(),

                TextColumn::make('description')
                    ->wrap()
                    ->limit(50),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'credit' => 'Credit',
                        'debit' => 'Debit',
                    ]),

                SelectFilter::make('source')
                    ->options([
                        'sms' => 'SMS',
                        'whatsapp' => 'WhatsApp',
                        'payment' => 'Payment',
                        'refund' => 'Refund',
                        'admin' => 'Admin',
                    ]),
            ])
            ->defaultSort('id', 'desc')
            ->actions([]) // no edit
            ->bulkActions([]); // no delete
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWalletTransactions::route('/'),
        ];
    }
}
