<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Edukasi extends Model
{
    protected $table = 'edukasis';
    
    protected $fillable = [
        'judul',
        'konten',
        'image',
        'thumbnail', // Tambahkan ini
        'kategori',
        'ringkasan',
        'original_name',
        'mime_type',
        'size',
        'dimensions'
    ];
    
    protected $casts = [
        'size' => 'integer',
    ];
    
    /**
     * URL gambar utama
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    
    /**
     * URL thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && \Storage::disk('public')->exists($this->thumbnail)) {
            return asset('storage/' . $this->thumbnail);
        }
        // Fallback ke gambar utama
        return $this->image_url;
    }
    
    /**
     * Format size file
     */
    public function getFormattedSizeAttribute()
    {
        if (!$this->size) return '-';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = $this->size;
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}