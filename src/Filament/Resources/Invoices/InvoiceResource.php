<?php

namespace Bishopm\Lightworx\Filament\Resources\Invoices;

use Bishopm\Lightworx\Filament\Resources\Invoices\Pages\CreateInvoice;
use Bishopm\Lightworx\Filament\Resources\Invoices\Pages\EditInvoice;
use Bishopm\Lightworx\Filament\Resources\Invoices\Pages\ListInvoices;
use Bishopm\Lightworx\Filament\Resources\Invoices\Schemas\InvoiceForm;
use Bishopm\Lightworx\Filament\Resources\Invoices\Tables\InvoicesTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Invoice;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return InvoiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoicesTable::configure($table);
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
            'index' => ListInvoices::route('/'),
            'create' => CreateInvoice::route('/create'),
            'edit' => EditInvoice::route('/{record}/edit'),
        ];
    }
}
