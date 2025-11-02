<?php

namespace Bishopm\Lightworx\Filament\Resources\Quotes;

use Bishopm\Lightworx\Filament\Resources\Quotes\Pages\CreateQuote;
use Bishopm\Lightworx\Filament\Resources\Quotes\Pages\EditQuote;
use Bishopm\Lightworx\Filament\Resources\Quotes\Pages\ListQuotes;
use Bishopm\Lightworx\Filament\Resources\Quotes\Schemas\QuoteForm;
use Bishopm\Lightworx\Filament\Resources\Quotes\Tables\QuotesTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Quote;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return QuoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            'Bishopm\Lightworx\Filament\Resources\Invoices\RelationManagers\HoursRelationManager',
            'Bishopm\Lightworx\Filament\Resources\Invoices\RelationManagers\DisbursementsRelationManager'
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuotes::route('/'),
            'create' => CreateQuote::route('/create'),
            'edit' => EditQuote::route('/{record}/edit'),
        ];
    }
}
