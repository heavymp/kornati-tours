<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\UserResource;

class MpPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('mp')
            ->path('mp')
            ->login()
            ->brandName('Kornati Tours')
            ->brandLogo(asset('images/light/logo.svg'))
            ->darkModeBrandLogo(asset('images/dark/logo.svg'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('images/light/favicon.svg'))
            ->topNavigation(false)
            ->maxContentWidth('full')
            ->colors([
                'primary' => [
                    50 => '249, 250, 251',
                    100 => '243, 244, 246',
                    200 => '229, 231, 235',
                    300 => '209, 213, 219',
                    400 => '156, 163, 175',
                    500 => '107, 114, 128',
                    600 => '75, 85, 99',
                    700 => '55, 65, 81',
                    800 => '31, 41, 55',
                    900 => '17, 24, 39',
                    950 => '3, 7, 18',
                ],
                'gray' => [
                    50 => '249, 250, 251',
                    100 => '243, 244, 246',
                    200 => '229, 231, 235',
                    300 => '209, 213, 219',
                    400 => '156, 163, 175',
                    500 => '107, 114, 128',
                    600 => '75, 85, 99',
                    700 => '55, 65, 81',
                    800 => '31, 41, 55',
                    900 => '17, 24, 39',
                    950 => '3, 7, 18',
                ],
            ])
            ->darkMode()
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'Tours',
                'Bookings',
                'Settings',
                'Administration',
            ])
            ->resources([
                UserResource::class,
            ])
            ->viteTheme('resources/css/filament/mp/theme.css')
            ->spa()
            ->navigationItems([
                // ... your navigation items
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications();
    }
}
