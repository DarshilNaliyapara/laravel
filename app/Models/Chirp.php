<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Chirp extends Model
{
    use HasFactory;
    protected $fillable = [
       'id',
        'message',
       
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function replies(): HasMany
{
    return $this->hasMany(Reply::class,'chirp_id','id');
}
}
