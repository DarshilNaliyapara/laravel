<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Reply extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'replies',
        'user_id', 
        'chirp_id'
      
    ];
    public function chirps()
    {
        return $this->belongsTo(Chirp::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
