<?php

namespace Bishopm\Lightworx\Filament\Resources\Invoices\Pages;

use Bishopm\Lightworx\Filament\Resources\Invoices\InvoiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected $listeners = ['refresh-total' => 'refreshTotal'];

    public function refreshTotal()
    {
        $this->form->fill(['total' => $this->record->fresh()->total]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        $record = $this->getRecord();

        return [
            route('filament.admin.resources.invoices.index') => 'Invoices',
            route('filament.admin.resources.invoices.edit', $record) => 'Invoice ' . $record->id,
            null => 'Edit',
        ];
    }

    public function getTitle(): string
    {
        $record = $this->getRecord();

        return 'Edit Invoice ' . $record->id;
    }
}
