<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriApp extends Model
{
    use HasFactory;

    protected $table = 'kategori_app';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'icon',
        'color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });

        static::updating(function ($kategori) {
            if ($kategori->isDirty('nama_kategori')) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });
    }

    /**
     * Get all apps that belong to this category
     */
    public function apps()
    {
        return $this->hasMany(MasterApp::class, 'kategori_app_id');
    }

    /**
     * Get active apps that belong to this category
     */
    public function activeApps()
    {
        return $this->hasMany(MasterApp::class, 'kategori_app_id')->where('is_active', true);
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered categories
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('nama_kategori');
    }
}
