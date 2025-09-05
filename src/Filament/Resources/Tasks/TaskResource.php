<?php

namespace Bishopm\Lightworx\Filament\Resources\Tasks;

use Bishopm\Lightworx\Filament\Resources\Tasks\Pages\CreateTask;
use Bishopm\Lightworx\Filament\Resources\Tasks\Pages\EditTask;
use Bishopm\Lightworx\Filament\Resources\Tasks\Pages\ListTasks;
use Bishopm\Lightworx\Filament\Resources\Tasks\Schemas\TaskForm;
use Bishopm\Lightworx\Filament\Resources\Tasks\Tables\TasksTable;
use BackedEnum;
use Bishopm\Lightworx\Models\Task;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static ?string $recordTitleAttribute = 'task';

    public static function form(Schema $schema): Schema
    {
        return TaskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TasksTable::configure($table);
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
            'index' => ListTasks::route('/'),
            'create' => CreateTask::route('/create'),
            'edit' => EditTask::route('/{record}/edit'),
        ];
    }
}
