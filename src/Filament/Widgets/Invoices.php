<?php

namespace Bishopm\Lightworx\Filament\Widgets;

use Bishopm\Lightworx\Models\Invoice;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class Invoices extends Widget
{
    protected string $view = 'lightworx::widgets.invoices';

    public ?array $widgetdata;

    function mount() {
        $this->widgetdata['invoices']=Invoice::with('client')->whereNull('invoicedate')->where('total','>',0)->orderBy('invoicedate','DESC')->get();
    }

    public static function canView(): bool 
    { 
        /*$roles =auth()->user()->roles->toArray(); 
        $permitted = array('Office','Finance','Worship');
        foreach ($roles as $role){
            if ((in_array($role['name'],$permitted)) or (auth()->user()->isSuperAdmin())){
                return true;
            }
        }
        return false;*/
        return true;
    }
}
