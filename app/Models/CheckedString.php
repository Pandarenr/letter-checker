<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\StringCheckService;

class CheckedString extends Model
{
    use HasFactory;

    protected $fillable=[
        'string',
        'lang',
    ];
}