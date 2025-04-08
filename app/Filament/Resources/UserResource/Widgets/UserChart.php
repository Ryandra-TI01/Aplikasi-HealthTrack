<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    public ?string $filter = 'today';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '350px';
    protected function getData(): array
    {
        $data = User::selectRaw("TO_CHAR(created_at, 'Mon') as bulan, COUNT(*) as total")
            ->whereYear('created_at', now()->year)
            ->groupByRaw("TO_CHAR(created_at, 'Mon')")
            ->orderByRaw("MIN(DATE_TRUNC('month', created_at))")
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'New Users',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $data->pluck('bulan'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
