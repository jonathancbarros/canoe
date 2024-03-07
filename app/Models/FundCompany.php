<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FundCompany extends Pivot
{
    protected $fillable = [
        'fund_id',
        'company_id',
    ];
}
