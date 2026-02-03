<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\WalletTopupResource\Pages;
use App\Models\WalletTopup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Hidden;

class WalletTopupResource extends Resource
{
    protected static ?string $model = WalletTopup::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Wallet Topups';
    protected static ?string $navigationGroup = 'Billing';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->required()
                ->label('Topup Amount'),

            Forms\Components\Select::make('payment_method')
                ->options([
                    'Cash' => 'Cash',
                    'bkash' => 'bKash',
                    'nagad' => 'Nagad',
                    'rocket' => 'Rocket',
                    'Cheque' => 'Cheque',
                    'bank' => 'Bank Transfer',
                ])
                ->required(),

            Forms\Components\TextInput::make('trx_id')
                ->label('Transaction ID')
                ->required(),

            Forms\Components\FileUpload::make('proof_image')
                ->image()
                ->directory('wallet-topups')
                ->label('Payment Proof'),

            Forms\Components\Hidden::make('status')->default('pending'),

            // Forms\Components\Hidden::make('client_id')
            //     ->default(fn () => auth()->user()->id),
           Forms\Components\Hidden::make('client_id')
                ->default(fn () => auth()->user()?->clientConfigurations?->first()?->id)
                ->required(),


        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),

                TextColumn::make('amount')
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->badge()
                    ->color('info'),

                TextColumn::make('trx_id')
                    ->label('Trx ID')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
                TextColumn::make('approvedBy.name')
                    ->label('Approved By')
                    ->searchable(),    

                ImageColumn::make('proof_image')
                    ->label('Proof')
                    ->circular(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Requested At')
                    ->sortable(),
                 TextColumn::make('approved_at')
                    ->label('Approved At')
                    ->dateTime()
                    ->sortable(),     
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWalletTopups::route('/'),
            'create' => Pages\CreateWalletTopup::route('/create'),
        ];
    }
}
