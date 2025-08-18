<?php

namespace Bishopm\Lightworx\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    
    public $table = 'clients';
    protected $guarded = ['id'];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

}
