<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletTransaction;
use App\Models\SmsBulkMessage;
use App\Models\MyWhatsappDevice;
use Carbon\Carbon;

class DashboardStats extends StatsOverviewWidget
{
    protected array|string|int $columnSpan = 12;
    
    function getHeading(): string
    {
        return 'Messages Sent Overview';
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        $clientId = $user->client?->id; // Use client_id
        $today = Carbon::today();

        // WALLET BALANCE
        $totalCredit = WalletTransaction::where('client_id', $clientId)
            ->where('type', 'credit')
            ->sum('amount');

        $totalDebit = WalletTransaction::where('client_id', $clientId)
            ->where('type', 'debit')
            ->sum('amount');

        $walletBalance = $totalCredit - $totalDebit;

        // MESSAGES TODAY
        $messagesToday = SmsBulkMessage::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->count();

        // DELIVERED
        $delivered = SmsBulkMessage::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->where('status', 'delivered')
            ->count();

        // FAILED
        $failed = SmsBulkMessage::where('user_id', $user->id)
            ->whereDate('created_at', $today)
            ->where('status', 'failed')
            ->count();

        // SUCCESS RATE
        $successRate = $messagesToday > 0
            ? round(($delivered / $messagesToday) * 100, 2)
            : 0;

        // ACTIVE DEVICES
        $activeDevices = MyWhatsappDevice::where('user_id', $user->id)
            ->where('status', 'connected')
            ->count();

        return [
            Stat::make('Wallet Balance', '৳ ' . number_format($walletBalance, 2))
                ->description('Available Balance')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($walletBalance > 0 ? 'success' : 'danger'),

            Stat::make('Messages Today', $messagesToday)
                ->description('Total messages sent today')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color('primary'),

            Stat::make('Success Rate', $successRate . '%')
                ->description("Delivered: $delivered | Failed: $failed")
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color(
                    $successRate >= 80 ? 'success' :
                    ($successRate >= 50 ? 'warning' : 'danger')
                ),

            Stat::make('Active Devices', $activeDevices)
                ->description('WhatsApp connected')
                ->descriptionIcon('heroicon-m-device-phone-mobile')
                ->color($activeDevices > 0 ? 'success' : 'danger'),
        ];
    }
}
