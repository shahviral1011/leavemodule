<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTotalLeave extends Model
{
    use HasFactory;

    protected $table = 'user_total_leaves';

    protected $fillable = [
        'user_id',
        'cl',
        'pl',
        'sl',
    ];
}
