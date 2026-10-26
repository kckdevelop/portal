<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    protected $fillable = [
        'name',
        'institution',
        'message',
        'selfie_path',
        'rating',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    /**
     * Get selfie photo URL helper
     */
    public function getSelfieUrlAttribute(): ?string
    {
        if (!$this->selfie_path) {
            return null;
        }

        if (str_starts_with($this->selfie_path, 'http://') || str_starts_with($this->selfie_path, 'https://')) {
            return $this->selfie_path;
        }

        return asset('storage/' . $this->selfie_path);
    }
}
