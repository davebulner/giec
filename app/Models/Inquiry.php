<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    public const STATUSES = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'enrolled' => 'Enrolled',
    ];

    protected $fillable = [
        'program_id',
        'full_name',
        'email',
        'phone',
        'preferred_format',
        'selected_package',
        'message',
        'status',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
