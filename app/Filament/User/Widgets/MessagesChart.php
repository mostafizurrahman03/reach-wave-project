<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\SmsBulkMessage;
use Illuminate\Support\Facades\Auth;

class MessagesChart extends ChartWidget
{
    protected array|string|int $columnSpan = 12;
    
    protected static ?string $heading = 'SMS Sent Per Month';

    protected static ?string $maxHeight = '300px';
  
    protected function getData(): array
    {
        $user = Auth::user();

        $data = Trend::query(
            SmsBulkMessage::where('user_id', $user->id)
        )
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'SMS Sent',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
