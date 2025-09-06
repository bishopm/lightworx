<?php

namespace Bishopm\Lightworx\Filament\Widgets;

use Bishopm\Lightworx\Models\Task;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class IncompleteTasks extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Task::where('completed_at', null))
            ->emptyStateHeading('No incomplete tasks')
            ->emptyStateIcon('heroicon-o-check-circle')
            ->columns([
                TextColumn::make('task'),
                TextColumn::make('project.project')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) => route('filament.admin.resources.tasks.edit', [
                        'record' => $record->id,
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
