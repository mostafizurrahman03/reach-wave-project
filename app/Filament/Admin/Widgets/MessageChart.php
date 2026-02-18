<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\SmsBulkMessage;
use App\Models\BulkMediaMessageRecipient;
use App\Models\BulkSendMessageRecipient;
use App\Models\SendMediaMessage;
use App\Models\SendMessage;
use Carbon\Carbon;

class MessageChart extends LineChartWidget
{
    protected static ?string $heading = 'Daily Messages (SMS & WhatsApp)';

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($i) =>
            Carbon::now()->subDays($i)->format('Y-m-d')
        );

        $whatsapp = [];
        $sms = [];

        foreach ($days as $day) {
            $whatsapp[] =
                BulkMediaMessageRecipient::whereDate('created_at', $day)->count()
                + BulkSendMessageRecipient::whereDate('created_at', $day)->count()
                + SendMediaMessage::whereDate('created_at', $day)->count()
                + SendMessage::whereDate('created_at', $day)->count();

            $sms[] = SmsBulkMessage::whereDate('created_at', $day)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'WhatsApp',
                    'data' => $whatsapp,
                    'borderColor' => '#25D366',
                ],
                [
                    'label' => 'SMS',
                    'data' => $sms,
                    'borderColor' => '#0badb5',
                ],
            ],
            'labels' => $days->map(fn ($d) => Carbon::parse($d)->format('D'))->toArray(),
        ];
    }
}
