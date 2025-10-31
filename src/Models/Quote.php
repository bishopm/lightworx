<?php

namespace Bishopm\Lightworx\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Quote extends Model
{

    public $table = 'quotes';
    protected $guarded = ['id'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function hours(): MorphMany
    {
        return $this->morphMany(Hour::class, 'hourable');
    }

    public function disbursements(): HasMany
    {
        return $this->hasMany(Disbursement::class, 'disbursable');
    }
}
