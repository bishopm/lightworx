<?php

namespace Bishopm\Lightworx\Filament\Widgets;

use Bishopm\Lightworx\Models\Client;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ClientAccounts extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Client::query())
            ->columns([
                TextColumn::make('client'),
                TextColumn::make('account')
                    ->numeric()
                    ->prefix('R ')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordUrl(fn ($record) => 
                route('filament.admin.resources.payments.create', [
                    'client_id' => $record->id,
                ])
            )
            ->recordActions([
                Action::make('makePayment')
                    ->label('Record payment')
                    ->icon('heroicon-o-banknotes')
                    ->url(fn ($record) => route('filament.admin.resources.payments.create', [
                        'client_id' => $record->id,
                    ]))
                    ->openUrlInNewTab(false), 
                ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
