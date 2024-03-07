<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAlias extends Model
{
    protected $fillable = [
        'name',
        'fund_id',
    ];

    use HasFactory;
}
