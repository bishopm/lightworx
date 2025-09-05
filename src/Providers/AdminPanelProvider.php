<?php

namespace Bishopm\Lightworx\Providers;

use Bishopm\Lightworx\Filament\Widgets\ClientAccounts;
use Bishopm\Lightworx\Filament\Widgets\UnsentInvoices;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
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
            ->login()
            ->profile()
            ->colors([
                'primary' => Color::Teal,
            ])
            ->discoverResources(in: base_path('vendor/bishopm/lightworx/src/Filament/Resources'), for: 'Bishopm\Lightworx\Filament\Resources')
            ->discoverPages(in: base_path('vendor/bishopm/lightworx/src/Filament/Pages'), for: 'Bishopm\Lightworx\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: base_path('vendor/bishopm/lightworx/src/Filament/Widgets'), for: 'Bishopm\Lightworx\Filament\Widgets')
            ->widgets([
                UnsentInvoices::class,
                ClientAccounts::class
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
            ->userMenuItems([
                Action::make('settings')
                    ->url('/admin/settings')
                    ->icon('heroicon-o-cog-6-tooth'),
                Action::make('website')
                    ->label('Website')
                    ->url('/')
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-globe-alt'),
            ]);
    }
}
