<?php

namespace Bishopm\Lightworx\Filament\Resources\Clients;

use Bishopm\Lightworx\Filament\Resources\Clients\Pages\CreateClient;
use Bishopm\Lightworx\Filament\Resources\Clients\Pages\EditClient;
use Bishopm\Lightworx\Filament\Resources\Clients\Pages\ListClients;
use Bishopm\Lightworx\Filament\Resources\Clients\Schemas\ClientForm;
use Bishopm\Lightworx\Filament\Resources\Clients\Tables\ClientsTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Client;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $recordTitleAttribute = 'client';

    public static function form(Schema $schema): Schema
    {
        return ClientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClientsTable::configure($table);
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
            'index' => ListClients::route('/'),
            'create' => CreateClient::route('/create'),
            'edit' => EditClient::route('/{record}/edit'),
        ];
    }
}
