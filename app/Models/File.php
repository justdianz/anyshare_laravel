<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class File extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $with = ['user', 'fileCategory'];
    protected $casts = [
        'schedule_delete_at' => 'timestamp',
    ];
    public function fileCategory(): BelongsTo
    {
        return $this->belongsTo(FileCategory::class,);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value)
        );
    }
}
