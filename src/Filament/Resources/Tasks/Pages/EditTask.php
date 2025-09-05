<?php

namespace Bishopm\Lightworx\Filament\Resources\Tasks\Pages;

use Bishopm\Lightworx\Filament\Resources\Tasks\TaskResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
