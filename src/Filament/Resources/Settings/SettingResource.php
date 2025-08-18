<?php

namespace Bishopm\Lightworx\Filament\Resources\Settings;

use Bishopm\Lightworx\Filament\Resources\Settings\Pages\CreateSetting;
use Bishopm\Lightworx\Filament\Resources\Settings\Pages\EditSetting;
use Bishopm\Lightworx\Filament\Resources\Settings\Pages\ListSettings;
use Bishopm\Lightworx\Filament\Resources\Settings\Schemas\SettingForm;
use Bishopm\Lightworx\Filament\Resources\Settings\Tables\SettingsTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Setting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'setting';

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
