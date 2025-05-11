<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    public ?string $filter = 'year';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '350px';
    protected function getData(): array
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        switch ($this->filter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'year':
            default:
                // Sudah diatur sebelumnya
                break;
        }

        $data = User::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("DATE_TRUNC('month', created_at) as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Pengguna Baru',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => 'rgba(45, 128, 90, 0.4)',
                    'borderColor' => '#2D805A',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $data->pluck('month')->map(fn($date) => \Carbon\Carbon::parse($date)->format('M')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
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
