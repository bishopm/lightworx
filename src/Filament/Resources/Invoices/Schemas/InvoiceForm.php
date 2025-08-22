<?php

namespace Bishopm\Lightworx\Filament\Resources\Invoices\Schemas;

use Bishopm\Lightworx\Models\Client;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->options(Client::query()->pluck('client', 'id'))
                    ->required(),
                TextInput::make('rate')->label('Hourly rate')
                    ->numeric()
                    ->default(function (){
                        return setting('hourly_rate');
                    }),
                TextEntry::make('invoicedate')
                    ->hiddenOn('create')
                    ->label('Date invoice sent')
                    ->placeholder('Not sent yet'),
                TextInput::make('total')
                    ->hiddenOn('create')
                    ->readonly(),
            ]);
    }
}
