<?php

namespace Bishopm\Lightworx\Filament\Resources\Payments;

use Bishopm\Lightworx\Filament\Resources\Payments\Pages\CreatePayment;
use Bishopm\Lightworx\Filament\Resources\Payments\Pages\EditPayment;
use Bishopm\Lightworx\Filament\Resources\Payments\Pages\ListPayments;
use Bishopm\Lightworx\Filament\Resources\Payments\Schemas\PaymentForm;
use Bishopm\Lightworx\Filament\Resources\Payments\Tables\PaymentsTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Payment;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PaymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentsTable::configure($table);
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
            'index' => ListPayments::route('/'),
            'create' => CreatePayment::route('/create'),
            'edit' => EditPayment::route('/{record}/edit'),
        ];
    }
}
