<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
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
            ->login()

            // 💡 Tambahkan di sini:
            ->brandLogo(asset('assets_frontend/img/logo.jpg'))
            ->brandLogoHeight('4rem')

            ->colors([
                'primary' => Color::Green,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                'panels::head.start',
                fn() => '
                <title>Admin Panel Dewan Dakwah Risalah Islamiyyah</title>'
            )
            ->renderHook(
                'panels::head.end',
                fn() => <<<'HTML'
                <style>
                    .fi-sidebar.fi-main-sidebar {
                        background: linear-gradient(180deg, #f8faf7 0%, #eef4ec 100%);
                        border-inline-end: 1px solid rgba(41, 84, 46, 0.10);
                        box-shadow: 12px 0 30px rgba(32, 58, 36, 0.08);
                    }

                    .fi-sidebar-header {
                        background: transparent;
                    }

                    .fi-logo {
                        border-radius: 18px;
                    }

                    .fi-sidebar-nav {
                        padding-top: 0.5rem;
                    }

                    .fi-sidebar-group-label {
                        color: #55715b;
                        font-size: 0.72rem;
                        font-weight: 700;
                        letter-spacing: 0.08em;
                        text-transform: uppercase;
                    }

                    .fi-sidebar-item-btn {
                        border-radius: 14px;
                    }

                    .fi-sidebar-item-btn:hover {
                        background-color: rgba(54, 95, 61, 0.08);
                    }

                    .fi-sidebar-item-active .fi-sidebar-item-btn,
                    .fi-sidebar-item-btn[aria-current='page'] {
                        background: linear-gradient(135deg, #2d7a3d 0%, #4ca95b 100%);
                        box-shadow: 0 12px 24px rgba(45, 122, 61, 0.20);
                    }

                    .fi-sidebar-item-active .fi-sidebar-item-label,
                    .fi-sidebar-item-active .fi-sidebar-item-icon,
                    .fi-sidebar-item-btn[aria-current='page'] .fi-sidebar-item-label,
                    .fi-sidebar-item-btn[aria-current='page'] .fi-sidebar-item-icon {
                        color: #ffffff;
                    }

                    .fi-topbar {
                        border-bottom: 1px solid rgba(41, 84, 46, 0.10);
                        box-shadow: 0 12px 30px rgba(32, 58, 36, 0.06);
                    }
                </style>
                HTML
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Dokumentasi Template')
                    ->group('Referensi')
                    ->sort(1)
                    ->icon(Heroicon::OutlinedBookOpen)
                    ->url(asset('Espire - Bootstrap Admin Template/html/documentation/index.html'), shouldOpenInNewTab: true),
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
            ]);
    }
}
