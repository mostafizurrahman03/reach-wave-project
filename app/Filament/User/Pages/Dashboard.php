<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use App\Filament\User\Widgets\MyWhatsappDeviceStats;
use App\Filament\User\Widgets\DashboardStats;
use App\Filament\User\Widgets\MessagesChart;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.user.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            MyWhatsappDeviceStats::class,   
            DashboardStats::class,          
            MessagesChart::class,           
        ];
    }

    public function getWidgets(): array
    {
        return [
            // future tables / lists
        ];
    }
}
