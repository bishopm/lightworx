<?php

namespace Bishopm\Lightworx\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hour extends Model
{
    
    public $table = 'hours';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

}
