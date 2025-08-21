<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="text-lg font-bold mb-4">Invoices to be sent</h2>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="px-2 py-1 text-left">Client</th>
                    <th class="px-2 py-1 text-left">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($widgetdata['invoices'] as $invoice)
                    <tr class="border-b">
                        <td class="px-2 py-1">{{$invoice->client->client}}</td>
                        <td class="px-2 py-1">{{$invoice->total}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-filament::section>
</x-filament-widgets::widget>
