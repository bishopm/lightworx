<?php

namespace Bishopm\Lightworx\Filament\Resources\Invoices\RelationManagers;

use Bishopm\Lightworx\Models\Invoice;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HoursRelationManager extends RelationManager
{
    protected static string $relationship = 'hours';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('hourdate')->label('Date')
                    ->default(now())
                    ->required(),
                TextInput::make('details')
                    ->required(),
                TextInput::make('hours')
                    ->default(1)
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('details')
            ->columns([
                TextColumn::make('hourdate')->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('details')
                    ->searchable(),
                TextColumn::make('hours')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                ->after(function (Model $record) {
                    $parent=Invoice::with('hours','disbursements')->where('id',$record->invoice_id)->first();
                    $total=0;
                    foreach ($parent->hours as $hour){
                        $total=$total+($hour->hours*$parent->rate);
                    }
                    foreach ($parent->disbursements as $disbursement){
                        $total=$total+($disbursement->disbursement);
                    }
                    $parent->total=$total;
                    $parent->save();
                    $this->dispatch('refresh-total');
                })
            ])
            ->recordActions([
                EditAction::make()
                ->after(function (Model $record) {
                    $parent=Invoice::with('hours','disbursements')->where('id',$record->invoice_id)->first();
                    $total=0;
                    foreach ($parent->hours as $hour){
                        $total=$total+($hour->hours*$parent->rate);
                    }
                    foreach ($parent->disbursements as $disbursement){
                        $total=$total+($disbursement->disbursement);
                    }
                    $parent->total=$total;
                    $parent->save();
                    $this->dispatch('refresh-total');
                }),
                DeleteAction::make()
                ->after(function (Model $record) {
                    $parent=Invoice::with('hours','disbursements')->where('id',$record->invoice_id)->first();
                    $total=0;
                    foreach ($parent->hours as $hour){
                        $total=$total+($hour->hours*$parent->rate);
                    }
                    foreach ($parent->disbursements as $disbursement){
                        $total=$total+($disbursement->disbursement);
                    }
                    $parent->total=$total;
                    $parent->save();
                    $this->dispatch('refresh-total');
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
