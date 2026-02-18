<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use App\Filament\Admin\Widgets\WhatsappDeviceStats;
use App\Filament\Admin\Widgets\AllMessagesStats;
use App\Filament\Admin\Widgets\MessageChart;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.admin.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            WhatsappDeviceStats::class,   
            // DashboardStats::class,          
            // MessagesChart::class,
            // WhatsappDeviceStats::class,
            AllMessagesStats::class,
            MessageChart::class,           
        ];
    }

    public function getWidgets(): array
    {
        return [
            // future tables / lists
        ];
    }
}