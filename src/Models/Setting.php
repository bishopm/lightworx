<?php

namespace Bishopm\Lightworx\Models;

use Bishopm\Lightworx\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Taggable;
    
    public $table = 'settings';
    protected $guarded = ['id'];

    public static function getValue(string $slug, $default = null)
    {
        return static::where('setting', $slug)->value('value') ?? $default;
    }

}
