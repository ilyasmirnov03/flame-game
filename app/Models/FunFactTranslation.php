<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunFactTranslation extends Model
{
    use HasFactory;

    /**
     * Table name corresponding to this model.
     * @var string
     */
    protected $table = 'og_fun_fact_translations';

    /**
     * Not use timestamps for this model.
     * @var bool
     */
    public $timestamps = false;

    public function language(): BelongsTo {
        return $this->belongsTo(Language::class);
    }
}
