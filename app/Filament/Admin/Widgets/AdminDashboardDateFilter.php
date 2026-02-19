<?php

namespace App\Filament\Admin\Widgets;

use Livewire\Component;

class AdminDashboardDateFilter extends Component
{
    public ?string $startDate = null;
    public ?string $endDate = null;

    public function render()
    {
        return view('filament.widgets.admin-dashboard-date-filter');
    }
}

