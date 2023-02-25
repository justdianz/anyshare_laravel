<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $with = ['files'];
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
