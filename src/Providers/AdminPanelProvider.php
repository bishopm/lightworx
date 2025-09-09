<?php

namespace Bishopm\Lightworx\Providers;

use Filament\Actions\Action;
use Alareqi\FilamentPwa\FilamentPwaPlugin;
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
            ])
            ->plugins([
                FilamentPwaPlugin::make()
                ->name('Lightworx')
                ->shortName('Lightworx')
                ->description('Lightworx PWA')
                ->themeColor('#3B82F6')
                ->backgroundColor('#ffffff')
                ->standalone()
                ->language('en')
                ->ltr()
                ->enableInstallation(2000) // Show prompt after 2 seconds
                ->addShortcut('Dashboard', '/admin', 'Main dashboard')
                ->icons('images/icons', [72, 96, 128, 144, 152, 192, 384, 512])
                ->serviceWorker('my-app-v1.0.0', '/offline'),
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
