<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\BulkMediaMessageRecipient;
use App\Models\BulkSendMessageRecipient;
use App\Models\SendMediaMessage;
use App\Models\SendMessage;
use App\Models\SmsBulkMessage;

class AllMessagesStats extends StatsOverviewWidget
{
    protected array|string|int $columnSpan = 12;
    protected function getHeading(): string
    {
        return 'All Messages Overview';
    }

    protected function getCards(): array
    {
        
        // TOTAL
        
        $total = BulkMediaMessageRecipient::count()
            + BulkSendMessageRecipient::count()
            + SendMediaMessage::count()
            + SendMessage::count()
            + SmsBulkMessage::count();

        
        // WHATSAPP
        
        $whatsappDelivered =
            BulkMediaMessageRecipient::where('is_sent', 1)->count()
            + BulkSendMessageRecipient::where('is_sent', 1)->count()
            + SendMediaMessage::where('is_sent', 1)->count()
            + SendMessage::where('is_sent', 1)->count();

        $whatsappPending =
            BulkMediaMessageRecipient::where('is_sent', 0)->count()
            + BulkSendMessageRecipient::where('is_sent', 0)->count()
            + SendMediaMessage::where('is_sent', 0)->count()
            + SendMessage::where('is_sent', 0)->count();

        
        // SMS
        
        $smsDelivered = SmsBulkMessage::where('status', 'delivered')->count();
        $smsPending   = SmsBulkMessage::where('status', 'pending')->count();
        $smsFailed    = SmsBulkMessage::where('status', 'failed')->count();

        return [
            Card::make('Total Messages', $total)
                ->description('All messages (SMS + WhatsApp)')
                ->color('primary'),

            Card::make('WhatsApp Delivered', $whatsappDelivered)
                ->description("Pending: {$whatsappPending}")
                ->color('success'),

            Card::make('SMS Delivered', $smsDelivered)
                ->description("Pending: {$smsPending} | Failed: {$smsFailed}")
                ->color('warning'),
        ];
    }
}
