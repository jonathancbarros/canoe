<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_year',
        'fund_manager_id',
    ];

    public function aliases(): HasMany
    {
        return $this->hasMany(FundAlias::class);
    }

    public function fundManager(): BelongsTo
    {
        return $this->belongsTo(FundManager::class);
    }

    public function companies(): BelongsToMany
    {
        return $this
            ->belongsToMany(Company::class, 'fund_company');
    }
}
