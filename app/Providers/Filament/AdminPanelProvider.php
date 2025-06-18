<?php

namespace App\Providers\Filament;

use App\Filament\Resources\UserResource\Widgets\ActiveUserChart;
use App\Filament\Resources\UserResource\Widgets\UserChart;
use App\Filament\Resources\UserResource\Widgets\UserStatistics;
use App\Http\Middleware\BlockUserFromAdmin;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => '#1C5B3E',
            ])
            ->font('Poppins',GoogleFontProvider::class)
            ->brandLogo(asset('images/LOGO - HealthTrack.png'))
            ->brandLogoHeight('5rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                UserStatistics::class,
                UserChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                BlockUserFromAdmin::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->resources([
                config('filament-logger.activity_resource')
            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->url('/user/profile')
                    ->icon('heroicon-s-user-circle')
                ,
                MenuItem::make()
                    ->label('Dashboard User')
                    ->url('/dashboard')
                    ->icon('heroicon-s-home')
                ,
            ])
            ->navigationItems([
            NavigationItem::make('Analytics Pulse')
                ->url('/pulse', shouldOpenInNewTab: true)
                ->icon('heroicon-o-chart-bar')
                ->group('Analytics'),
                // ->sort(3),
        ]);
    }
}
