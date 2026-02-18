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
    protected function getHeading(): string
    {
        return 'All Messages Overview';
    }

    protected function getCards(): array
    {
        $total = BulkMediaMessageRecipient::count()
            + BulkSendMessageRecipient::count()
            + SendMediaMessage::count()
            + SendMessage::count()
            + SmsBulkMessage::count();

        $whatsapp = BulkMediaMessageRecipient::count()
            + BulkSendMessageRecipient::count()
            + SendMediaMessage::count()
            + SendMessage::count();

        $sms = SmsBulkMessage::count();

        return [
            Card::make('Total Messages', $total)
                ->description('All messages (SMS + WhatsApp)')
                ->color('primary')
                ->icon('heroicon-o-chat-bubble-left-right'),

            Card::make('WhatsApp Messages', $whatsapp)
                ->color('success')
                ->icon('heroicon-o-device-phone-mobile'),

            Card::make('SMS Messages', $sms)
                ->color('warning')
                ->icon('heroicon-o-chat-bubble-left'),

        ];
    }
}

