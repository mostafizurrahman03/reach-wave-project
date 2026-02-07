<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SmsBulkMessageResource\Pages;
use App\Models\SmsBulkMessage;
use App\Models\VendorConfiguration;
use App\Models\Lead;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;
// use App\Models\SmsSenderId;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Actions\Action;
use App\Exports\SmsBulkMessagesExport;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Section as FormSection;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField; 

use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Notifications\Notification;


class SmsBulkMessageResource extends Resource
{
    protected static ?string $model = SmsBulkMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'SMS Bulk Messages';
    protected static ?string $navigationGroup = 'Messaging';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('user_id')
                //     ->default(auth()->id())
                //     ->relationship('user', 'name')
                //     ->preload()
                //     ->searchable()
                //     ->required(),
                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => auth()->id())
                    ->required(),

                // Forms\Components\Select::make('vendor_configuration_id')
                //     ->label('Vendor')
                //     ->relationship('vendorConfiguration', 'vendor_name')
                //     ->preload()
                //     ->searchable()
                //     ->nullable(),
                
                Hidden::make('vendor_configuration_id')
                    ->default(fn () => auth()->user()?->vendor_configuration_id)
                    ->required(),
                
                Forms\Components\Select::make('campaign_id')
                    ->label('Select Campaign')
                    ->options(fn () => Campaign::where('user_id', auth()->id())->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->visible(fn () => Campaign::where('user_id', auth()->id())->exists()),                    

                Forms\Components\Select::make('service_id')
                    ->label('Service')
                    ->relationship('service', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Select::make('sender_id')
                    ->label('Sender ID')
                    ->options(function () {
                        return VendorConfiguration::where('is_active', true)
                            ->pluck('sender_ids')   // assume array/json column
                            ->flatten()
                            ->filter()
                            ->unique()
                            ->mapWithKeys(fn ($sender) => [
                                $sender => $sender, // value => label
                            ])
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\Textarea::make('content')
                    ->label('Message Content')
                    ->rows(4)
                    ->required(),
               
                // Right column (2nd column)
                        FormSection::make('Recipients')
                            ->columnSpan(1)
                            ->schema([
                                Radio::make('input_method')
                                    ->label('Select Input Method')
                                    ->options([
                                        'manual' => 'Manual Entry',
                                        'csv' => 'Upload CSV File',
                                        'lead' => 'From Lead List',
                                    ])
                                    ->default('manual')
                                    ->inline()
                                    ->reactive(),

                                
                                //  Show only the logged-in user’s leads
                                Select::make('lead_id')
                                    ->label('Select Lead Name')
                                    ->options(function () {
                                        // leads fetch for logged-in user
                                        $leads = Lead::where('user_id', auth()->id())
                                            ->select('name', 'id') 
                                            ->get()
                                            ->groupBy('name');  

                                        $options = [];
                                        foreach ($leads as $name => $group) {
                                            $count = $group->count(); // row count according to name
                                            // if name null, then shows phone number
                                            $displayName = $name ?? $group->first()->phone;
                                            // dropdown option
                                            $options[$group->first()->id] = "{$displayName} ({$count})";
                                        }

                                        return $options;
                                    })
                                    ->searchable()
                                    ->placeholder('Select a lead')
                                    ->visible(fn ($get) => $get('input_method') === 'lead'),

                                TagsInput::make('recipients')
                                    ->label('Receiver Numbers')
                                    ->placeholder('8801XXXXXXXXX')
                                    ->required()
                                    ->reactive()
                                    ->separator(',')
                                    ->visible(fn ($get) => $get('input_method') === 'manual')
                                    ->helperText('Enter multiple numbers separated by commas. Only valid Bangladeshi phone numbers are allowed.')
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if (is_array($state)) {
                                            foreach ($state as $value) {
                                                // Remove all non-digit characters
                                                $number = preg_replace('/\D/', '', $value);

                                                // Validate Bangladeshi number format (+8801XXXXXXXXX or 8801XXXXXXXXX or 01XXXXXXXXX)
                                                if (!preg_match('/^(?:\+?88)?01[3-9]\d{8}$/', $number)) {
                                                    Notification::make()
                                                        ->title('Invalid Phone Number')
                                                        ->body("{$value} is not a valid Bangladeshi number. Format: 8801XXXXXXXXX")
                                                        ->danger()
                                                        ->send();

                                                    // Optionally, remove invalid numbers
                                                    $set('recipients', array_filter($state, fn ($num) => $num !== $value));

                                                    break;
                                                }
                                            }
                                        }
                                    }),
                                                                   
                                FileUpload::make('recipients_csv')
                                    ->label('Upload CSV of Numbers')
                                    ->helperText('Upload a CSV file containing phone numbers in one column.')
                                    ->disk('public')
                                    ->directory('recipients')
                                    ->acceptedFileTypes(['text/csv', 'text/plain'])
                                    ->maxSize(2048)
                                    ->visible(fn ($get) => $get('input_method') === 'csv'),


                                // Sample CSV download link
                                ViewField::make('sample_csv_link')
                                    ->view('filament.user.pages.sample-csv-link')
                                    ->visible(fn ($get) => $get('input_method') === 'csv'),    
                                ]),
                                        
                // Forms\Components\TextInput::make('total_recipients')
                //     ->label('Total Recipients')
                //     ->numeric()
                //     ->default(0)
                //     ->disabled(),
                // Forms\Components\Textarea::make('content')
                //     ->label('Message Content')
                //     ->rows(4)
                //     ->required(),                
                Forms\Components\TextInput::make('success_count')
                    ->label('Success Count')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Forms\Components\TextInput::make('failed_count')
                    ->label('Failed Count')
                    ->numeric()
                    ->default(0)
                    ->disabled(),

                Forms\Components\TextInput::make('cost')
                    ->label('Cost')
                    ->numeric()
                    ->default(0.00)
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'sent' => 'Sent',
                        'partial' => 'Partial',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\KeyValue::make('response')
                    ->label('API Response')
                    ->nullable(),

                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->label('Scheduled At')
                    ->nullable(),

                Forms\Components\DateTimePicker::make('sent_at')
                    ->label('Sent At')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('vendorConfiguration.vendor_name')
                    ->label('Vendor')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('sender_id')
                    ->label('Sender ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'success' => 'sent',
                        'secondary' => 'partial',
                        'danger' => 'failed',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_recipients')
                    ->label('Total'),

                Tables\Columns\TextColumn::make('success_count')
                    ->label('Success'),

                Tables\Columns\TextColumn::make('failed_count')
                    ->label('Failed'),

                Tables\Columns\TextColumn::make('cost')
                    ->label('Cost')
                    ->money('BDT', true),

                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime(),

                Tables\Columns\TextColumn::make('sent_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')

            ->filters([
                // Sender Device Filter
                Tables\Filters\SelectFilter::make('sender_id')
                    ->label('Sender Device')
                    ->options(
                        SmsBulkMessage::query()
                            ->whereNotNull('sender_id')
                            ->distinct()
                            ->pluck('sender_id', 'sender_id')
                            ->toArray()
                    )
                    ->searchable()
                    ->preload(),

                // Sent Status Filter
                // Tables\Filters\TernaryFilter::make('is_sent')
                //     ->label('Sent Status')
                //     ->trueLabel('Sent')
                //     ->falseLabel('Not Sent')
                //     ->queries(
                //         true: fn (Builder $query) => $query->where('is_sent', true),
                //         false: fn (Builder $query) => $query->where('is_sent', false),
                //         blank: fn (Builder $query) => $query,
                //     ),

                Tables\Filters\SelectFilter::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'sent' => 'Sent',
                            'partial' => 'Partial',
                            'failed' => 'Failed',
                        ]),    

                // Created Date Range Filter
                Tables\Filters\Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From'),
                        Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn ($q, $date) => $q->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn ($q, $date) => $q->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->columnSpan(2)->columns(2),
            ], layout: FiltersLayout::AboveContent)

            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Export Data')
                    ->fileName('bulk_send_message_recipients')
                    ->defaultFormat('xlsx')
                    ->withHiddenColumns()
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray'),
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

                FilamentExportBulkAction::make('export-selected')
                    ->label('Export Selected')
                    ->fileName('selected_recipients_export')
                    ->defaultFormat('xlsx'),
            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSmsBulkMessages::route('/'),
            'create' => Pages\CreateSmsBulkMessage::route('/create'),
            'edit' => Pages\EditSmsBulkMessage::route('/{record}/edit'),
        ];
    }
}

