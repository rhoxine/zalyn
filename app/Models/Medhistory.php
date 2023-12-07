<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medhistory extends Model
{
    use HasFactory;
    protected $table = "medhistory";
    protected $fillable = [
        'user_id',
        'question_id',
        'yes',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function questions(): BelongsTo
    {
        return $this->belongsTo(Questions::class, 'question_id', 'id');
    }
}
