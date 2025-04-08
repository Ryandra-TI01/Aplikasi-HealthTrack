<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Issue;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatistics extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Total Users', User::count())
            ->description('Total number of users')
            ->icon('heroicon-o-users')
            ->color('primary'),

            Card::make('Issue Open', Issue::where('status', 'open')->count())
                ->description('Issue not resolved')
                ->icon('heroicon-o-exclamation-circle')
                ->color('danger'),

            Card::make('Issue Solved', Issue::where('status', 'solved')->count())
                ->description('Issue resolved')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
