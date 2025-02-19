<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Widgets\AttendanceStats;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\AttendanceOverview;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Rupadana\ApiService\ApiServicePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandName('SMP ISLAM MIA')
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
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

            ->plugin(\TomatoPHP\FilamentUsers\FilamentUsersPlugin::make())


            ->plugin(\BezhanSalleh\FilamentShield\FilamentShieldPlugin::make())

            ->plugins([
                FilamentEditProfilePlugin::make()
                   ->slug('my-profile')
                   ->setTitle('My Profile')
                   ->setNavigationLabel('My Profile')
                   ->setNavigationGroup('User Management')
                   ->setIcon('heroicon-o-user')
                   ->setSort(10)
                   ->shouldShowDeleteAccountForm(false)
                   ->shouldShowBrowserSessionsForm()
            ])
            ->widgets([
                    AttendanceStats::class,
                    AttendanceOverview::class,
            ])
            ->navigationItems([
                NavigationItem::make('Dashboard')
                        ->url(fn (): string => Dashboard::getUrl())
                        ->icon('heroicon-o-home')
                        ->isActiveWhen(fn () => request()->routeIs('filament.pages.dashboard'))
                ])
            ->plugins([
                    ApiServicePlugin::make()
            ]);
    }
}
