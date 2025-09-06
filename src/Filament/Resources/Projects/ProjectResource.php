<?php

namespace Bishopm\Lightworx\Filament\Resources\Projects;

use Bishopm\Lightworx\Filament\Resources\Projects\Pages\CreateProject;
use Bishopm\Lightworx\Filament\Resources\Projects\Pages\EditProject;
use Bishopm\Lightworx\Filament\Resources\Projects\Pages\ListProjects;
use Bishopm\Lightworx\Filament\Resources\Projects\Schemas\ProjectForm;
use Bishopm\Lightworx\Filament\Resources\Projects\Tables\ProjectsTable;
use BackedEnum;
use Bishopm\Lightworx\Filament\Resources\Clients\ClientResource;
use Bishopm\Lightworx\Models\Project;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'project';

    protected static ?string $parentResource = ClientResource::class;

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            'Bishopm\Lightworx\Filament\Resources\Projects\RelationManagers\TasksRelationManager'
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
