<?php

namespace Bishopm\Lightworx\Filament\Resources\Invoices\Pages;

use Bishopm\Lightworx\Filament\Resources\Invoices\InvoiceResource;
use Bishopm\Lightworx\Models\Client;
use Bishopm\Lightworx\Models\Invoice;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
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
            Action::make('Send invoice')
                ->hidden(!is_null($this->record->invoicedate))
                ->icon('heroicon-o-envelope')
                ->action(function () {
                    $this->record->invoicedate=date('Y-m-d');
                    $this->record->save();
                    $client=Client::find($this->record->client_id);
                    $client->account=$client->account+$this->record->total;
                    $client->save();
                    /*$subject = 'New service: ' . $this->record->servicetime . " " . $this->record->servicedate;
                    $body = "Hi" . $fname . "<br><br>Just to let you know that a new service has been added to the database.<br><br>It can be accessed <a href=\"" . url('/') . "/admin/worship/services/" . $this->record->id . "/edit\">here</a><br><br>Thank you!";
                    Mail::html($body, function ($message) use ($email, $subject) {
                        $message->to($email)->subject($subject);
                        $message->from(setting('email.church_email'),setting('general.church_name'));
                    });*/
                    Notification::make('Email sent')->title('Invoice emailed to ' . $this->record->client->client)->send();
            }),
            Action::make('Invoice')
                ->icon('heroicon-o-document-text')
                ->url(function (Invoice $record){
                    return route('invoice', ['id' => $record]);
                }),
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
