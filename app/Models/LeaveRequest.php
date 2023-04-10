<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $table = 'leave_requests';

    protected $fillable = [
        'user_id ',
        'leave_type',
        'leave_type_shift_wise',
        'start_date ',
        'end_date',
        'days',
        'status',
        'emp_leave_reason',
        'rejection_reason',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
