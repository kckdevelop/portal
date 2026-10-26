<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppGallery extends Model
{
    public const JURUSAN_OPTIONS = ['TKR', 'TSM', 'TPM', 'TAV', 'PPLG'];

    public const JURUSAN_DETAILS = [
        'TKR' => [
            'code' => 'TKR',
            'name' => 'Teknik Kendaraan Ringan',
            'short' => 'Otomotif Roda 4',
            'badge_bg' => 'bg-blue-950/80 text-blue-300 border-blue-500/40',
            'pill_active' => 'bg-blue-600 text-white shadow-blue-600/30',
            'icon' => 'fa-solid fa-car',
            'color' => 'blue',
        ],
        'TSM' => [
            'code' => 'TSM',
            'name' => 'Teknik Sepeda Motor',
            'short' => 'Otomotif Roda 2',
            'badge_bg' => 'bg-amber-950/80 text-amber-300 border-amber-500/40',
            'pill_active' => 'bg-amber-600 text-white shadow-amber-600/30',
            'icon' => 'fa-solid fa-motorcycle',
            'color' => 'amber',
        ],
        'TPM' => [
            'code' => 'TPM',
            'name' => 'Teknik Pemesinan',
            'short' => 'Manufaktur & Bubut',
            'badge_bg' => 'bg-rose-950/80 text-rose-300 border-rose-500/40',
            'pill_active' => 'bg-rose-600 text-white shadow-rose-600/30',
            'icon' => 'fa-solid fa-gears',
            'color' => 'rose',
        ],
        'TAV' => [
            'code' => 'TAV',
            'name' => 'Teknik Audio Video',
            'short' => 'Elektronika & Audio',
            'badge_bg' => 'bg-purple-950/80 text-purple-300 border-purple-500/40',
            'pill_active' => 'bg-purple-600 text-white shadow-purple-600/30',
            'icon' => 'fa-solid fa-tv',
            'color' => 'purple',
        ],
        'PPLG' => [
            'code' => 'PPLG',
            'name' => 'Pengembangan Perangkat Lunak & Gim',
            'short' => 'Software & Gim',
            'badge_bg' => 'bg-cyan-950/80 text-cyan-300 border-cyan-500/40',
            'pill_active' => 'bg-cyan-600 text-white shadow-cyan-600/30',
            'icon' => 'fa-solid fa-laptop-code',
            'color' => 'cyan',
        ],
    ];

    protected $fillable = [
        'title',
        'student_name',
        'student_class',
        'jurusan',
        'category',
        'description',
        'thumbnail',
        'images',
        'tech_stacks',
        'canva_url',
        'demo_url',
        'github_url',
        'featured',
        'order',
    ];

    protected $casts = [
        'tech_stacks' => 'array',
        'images' => 'array',
        'featured' => 'boolean',
    ];

    /**
     * Get thumbnail URL helper
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (empty($this->thumbnail)) {
            return 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80';
        }

        if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }

    /**
     * Get all gallery images formatted with absolute URLs
     */
    public function getGalleryImagesAttribute(): array
    {
        $list = [];

        // Add main thumbnail as first image if available
        if (!empty($this->thumbnail_url)) {
            $list[] = $this->thumbnail_url;
        }

        // Add extra images if present
        if (!empty($this->images) && is_array($this->images)) {
            foreach ($this->images as $img) {
                if (empty($img)) continue;

                $url = (str_starts_with($img, 'http://') || str_starts_with($img, 'https://'))
                    ? $img
                    : asset('storage/' . $img);

                // Avoid duplicating the thumbnail
                if (!in_array($url, $list)) {
                    $list[] = $url;
                }
            }
        }

        return $list;
    }

    /**
     * Jurusan metadata helper
     */
    public function getJurusanDetailAttribute(): array
    {
        $key = strtoupper(trim($this->jurusan ?? 'PPLG'));

        return self::JURUSAN_DETAILS[$key] ?? [
            'code' => $key ?: 'PPLG',
            'name' => $key ?: 'PPLG',
            'short' => $key ?: 'PPLG',
            'badge_bg' => 'bg-slate-900/80 text-cyan-300 border-cyan-500/40',
            'pill_active' => 'bg-cyan-600 text-white',
            'icon' => 'fa-solid fa-graduation-cap',
            'color' => 'cyan',
        ];
    }

    /**
     * Backward compatibility for category
     */
    public function getCategoryAttribute($value)
    {
        return $this->jurusan ?? $value ?? 'PPLG';
    }
}
